"use strict";

const MAX_BODY_BYTES = 16 * 1024;
const MAX_EMAIL_LENGTH = 254;
const MAX_MESSAGE_LENGTH = 5000;
const REQUIRED_ENV = [
  "MAIL_HOST",
  "MAIL_PORT",
  "MAIL_USER",
  "MAIL_PASSWORD",
  "MAIL_ENCRYPTION",
  "MAIL_TO",
];

function jsonResponse(statusCode, body, headers = {}) {
  return {
    statusCode,
    headers: {
      "Cache-Control": "no-store",
      "Content-Type": "application/json; charset=utf-8",
      ...headers,
    },
    body,
  };
}

function getConfiguration(env) {
  if (REQUIRED_ENV.some((name) => !env[name])) {
    throw new Error("SMTP configuration is incomplete.");
  }

  const port = Number.parseInt(env.MAIL_PORT, 10);
  if (!Number.isInteger(port) || port < 1 || port > 65535) {
    throw new Error("SMTP configuration is invalid.");
  }

  const encryption = env.MAIL_ENCRYPTION.toLowerCase();
  if (!new Set(["tls", "starttls", "ssl"]).has(encryption)) {
    throw new Error("SMTP configuration is invalid.");
  }

  return {
    host: env.MAIL_HOST,
    port,
    user: env.MAIL_USER,
    password: env.MAIL_PASSWORD,
    encryption,
    to: env.MAIL_TO,
  };
}

function headerValue(headers, name) {
  const entry = Object.entries(headers || {}).find(
    ([key]) => key.toLowerCase() === name.toLowerCase(),
  );
  return entry ? entry[1] : undefined;
}

function isBodyTooLarge(event) {
  const contentLength = Number.parseInt(
    headerValue(event.http?.headers, "content-length") || "0",
    10,
  );
  if (Number.isFinite(contentLength) && contentLength > MAX_BODY_BYTES) {
    return true;
  }

  return Buffer.byteLength(JSON.stringify({
    name: event.name ?? "",
    email: event.email ?? "",
    message: event.message ?? "",
  })) > MAX_BODY_BYTES;
}

function parsePayload(event) {
  const name = typeof event.name === "string" ? event.name.trim() : "";
  const email = typeof event.email === "string" ? event.email.trim() : "";
  const message = typeof event.message === "string" ? event.message.trim() : "";

  if (name) {
    return { isBot: true };
  }

  const emailLooksValid = email.length <= MAX_EMAIL_LENGTH
    && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  const messageLooksValid = message.length > 0 && message.length <= MAX_MESSAGE_LENGTH;

  if (!emailLooksValid || !messageLooksValid) {
    return { error: "INVALID_REQUEST" };
  }

  return { email, message, isBot: false };
}

function createMain({ createTransport, env = process.env }) {
  return async function main(event = {}) {
    if ((event.http?.method || "").toUpperCase() !== "POST") {
      return jsonResponse(405, { ok: false, code: "METHOD_NOT_ALLOWED" }, { Allow: "POST" });
    }

    if (isBodyTooLarge(event)) {
      return jsonResponse(413, { ok: false, code: "REQUEST_TOO_LARGE" });
    }

    const payload = parsePayload(event);
    if (payload.isBot) {
      return jsonResponse(200, { ok: true });
    }
    if (payload.error) {
      return jsonResponse(400, { ok: false, code: payload.error });
    }

    let configuration;
    try {
      configuration = getConfiguration(env);
    } catch {
      return jsonResponse(503, { ok: false, code: "DELIVERY_UNAVAILABLE" });
    }

    const transport = createTransport({
      host: configuration.host,
      port: configuration.port,
      secure: configuration.encryption === "ssl",
      requireTLS: configuration.encryption !== "ssl",
      auth: {
        user: configuration.user,
        pass: configuration.password,
      },
      connectionTimeout: 8000,
      greetingTimeout: 8000,
      socketTimeout: 8000,
    });

    try {
      await transport.sendMail({
        from: configuration.user,
        to: configuration.to,
        replyTo: payload.email,
        subject: "Web-Opt contact request",
        text: `Contact from web-opt.com:\n\n${payload.message}`,
      });
      return jsonResponse(200, { ok: true });
    } catch {
      return jsonResponse(503, { ok: false, code: "DELIVERY_UNAVAILABLE" });
    } finally {
      transport.close();
    }
  };
}

function defaultCreateTransport(options) {
  return require("nodemailer").createTransport(options);
}

const main = createMain({ createTransport: defaultCreateTransport });

module.exports = {
  createMain,
  getConfiguration,
  isBodyTooLarge,
  jsonResponse,
  main,
  parsePayload,
};
