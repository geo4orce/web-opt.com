import assert from "node:assert/strict";
import test from "node:test";
import { JSDOM } from "jsdom";
import { initPage } from "../resources/js/page.js";

function renderPage() {
    const dom = new JSDOM(`<!doctype html><body>
        <button class="js-burger" aria-expanded="false"></button>
        <div class="js-mobile-navigation hidden"></div>
        <button class="js-contact-btn"></button>
        <span class="js-current-year"></span>
        <div class="js-contact-modal hidden">
            <form action="/api/contact-us" method="POST">
                <button type="button" class="js-contact-close"></button>
                <input name="name">
                <input class="js-contact-input" name="email">
                <textarea class="js-contact-input" name="message"></textarea>
                <button class="js-contact-input" type="submit">SEND</button>
                <div class="js-contact-success hidden"></div>
                <p class="js-contact-status hidden"></p>
                <button type="button" class="js-contact-close js-contact-success-close hidden"></button>
            </form>
        </div>
    </body>`, { url: "https://web-opt.test/" });
    globalThis.FormData = dom.window.FormData;
    return dom;
}

function settle() {
    return new Promise((resolve) => setTimeout(resolve, 0));
}

test("shows success only after a successful response", async () => {
    const dom = renderPage();
    let resolveRequest;
    let request;
    const response = new Promise((resolve) => { resolveRequest = resolve; });
    const fetchImpl = async (...args) => { request = args; return response; };
    const { form } = initPage({ documentRef: dom.window.document, fetchImpl });
    form.elements.email.value = "person@example.test";
    form.elements.message.value = "Hello";

    form.dispatchEvent(new dom.window.Event("submit", { bubbles: true, cancelable: true }));
    assert.equal(dom.window.document.querySelector(".js-contact-status").textContent, "Sending…");
    assert.equal(dom.window.document.querySelector(".js-contact-success").classList.contains("hidden"), true);

    resolveRequest({ ok: true });
    await settle();

    assert.equal(request[0], "https://web-opt.test/api/contact-us");
    assert.equal(request[1].method, "post");
    assert.deepEqual(JSON.parse(request[1].body), {
        name: "",
        email: "person@example.test",
        message: "Hello",
    });
    assert.equal(dom.window.document.querySelector(".js-contact-status").textContent, "Message sent.");
    assert.equal(dom.window.document.querySelector(".js-contact-success").classList.contains("hidden"), false);
});

test("keeps the form available and shows a generic failure", async () => {
    const dom = renderPage();
    const { form } = initPage({
        documentRef: dom.window.document,
        fetchImpl: async () => ({ ok: false }),
    });
    form.elements.email.value = "person@example.test";
    form.elements.message.value = "Hello";

    form.dispatchEvent(new dom.window.Event("submit", { bubbles: true, cancelable: true }));
    await settle();

    assert.equal(form.elements.email.disabled, false);
    assert.equal(form.elements.message.disabled, false);
    assert.equal(dom.window.document.querySelector(".js-contact-status").textContent, "Unable to send right now. Please try again.");
    assert.equal(dom.window.document.querySelector(".js-contact-success").classList.contains("hidden"), true);
});

test("opens and closes the mobile navigation", () => {
    const dom = renderPage();
    initPage({ documentRef: dom.window.document, fetchImpl: async () => ({ ok: true }) });
    const burger = dom.window.document.querySelector(".js-burger");
    const navigation = dom.window.document.querySelector(".js-mobile-navigation");

    burger.click();
    assert.equal(navigation.classList.contains("hidden"), false);
    assert.equal(burger.getAttribute("aria-expanded"), "true");

    navigation.click();
    assert.equal(navigation.classList.contains("hidden"), true);
    assert.equal(burger.getAttribute("aria-expanded"), "false");
});
