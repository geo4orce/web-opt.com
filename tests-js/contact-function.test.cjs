"use strict";

const assert = require("node:assert/strict");
const test = require("node:test");
const { createMain } = require("../functions/packages/api/contact-us/index.js");

const completeEnv = {
  MAIL_HOST: "smtp.example.test",
  MAIL_PORT: "587",
  MAIL_USER: "sender@example.test",
  MAIL_PASSWORD: "not-a-real-secret",
  MAIL_ENCRYPTION: "tls",
  MAIL_TO: "recipient@example.test",
};

function event(fields = {}, http = {}) {
  return {
    ...fields,
    http: {
      headers: {},
      method: "POST",
      ...http,
    },
  };
}

function fakeTransport(overrides = {}) {
  return {
    close() {},
    async sendMail() {},
    ...overrides,
  };
}

test("rejects methods other than POST", async () => {
  const main = createMain({ createTransport() { throw new Error("not expected"); }, env: completeEnv });
  const response = await main(event({}, { method: "GET" }));

  assert.equal(response.statusCode, 405);
  assert.equal(response.headers.Allow, "POST");
  assert.deepEqual(response.body, { ok: false, code: "METHOD_NOT_ALLOWED" });
});

test("rejects an oversized request before creating SMTP transport", async () => {
  let created = false;
  const main = createMain({
    createTransport() { created = true; return fakeTransport(); },
    env: completeEnv,
  });
  const response = await main(event(
    { email: "person@example.test", message: "hello" },
    { headers: { "content-length": "20000" } },
  ));

  assert.equal(response.statusCode, 413);
  assert.equal(created, false);
});

test("accepts honeypot submissions without sending mail", async () => {
  let created = false;
  const main = createMain({
    createTransport() { created = true; return fakeTransport(); },
    env: completeEnv,
  });
  const response = await main(event({ name: "bot", email: "", message: "" }));

  assert.equal(response.statusCode, 200);
  assert.deepEqual(response.body, { ok: true });
  assert.equal(created, false);
});

test("rejects invalid human submissions", async () => {
  const main = createMain({ createTransport() { throw new Error("not expected"); }, env: completeEnv });
  const response = await main(event({ email: "invalid", message: "hello" }));

  assert.equal(response.statusCode, 400);
  assert.deepEqual(response.body, { ok: false, code: "INVALID_REQUEST" });
});

test("sends a plain-text message with the visitor as Reply-To", async () => {
  let mail;
  let transportOptions;
  let closed = false;
  const main = createMain({
    createTransport(options) {
      transportOptions = options;
      return fakeTransport({
        close() { closed = true; },
        async sendMail(value) { mail = value; },
      });
    },
    env: completeEnv,
  });
  const response = await main(event({
    email: " visitor@example.test ",
    message: " Please call me. ",
  }));

  assert.equal(response.statusCode, 200);
  assert.deepEqual(response.body, { ok: true });
  assert.equal(transportOptions.auth.user, completeEnv.MAIL_USER);
  assert.equal(transportOptions.auth.pass, completeEnv.MAIL_PASSWORD);
  assert.deepEqual(mail, {
    from: completeEnv.MAIL_USER,
    to: completeEnv.MAIL_TO,
    replyTo: "visitor@example.test",
    subject: "Web-Opt contact request",
    text: "Contact from web-opt.com:\n\nPlease call me.",
  });
  assert.equal(closed, true);
});

test("returns a generic error when the provider fails", async () => {
  const main = createMain({
    createTransport() {
      return fakeTransport({
        async sendMail() { throw new Error("provider details must not escape"); },
      });
    },
    env: completeEnv,
  });
  const response = await main(event({ email: "person@example.test", message: "hello" }));

  assert.equal(response.statusCode, 503);
  assert.deepEqual(response.body, { ok: false, code: "DELIVERY_UNAVAILABLE" });
  assert.doesNotMatch(JSON.stringify(response), /provider details/);
});
