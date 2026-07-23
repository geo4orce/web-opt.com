const HIDDEN_CLASS = "hidden";

function setHidden(elements, hidden) {
    elements.forEach((element) => element.classList.toggle(HIDDEN_CLASS, hidden));
}

export function initPage({ documentRef = document, fetchImpl = globalThis.fetch } = {}) {
    const burger = documentRef.querySelector(".js-burger");
    const closeButtons = [...documentRef.querySelectorAll(".js-contact-close")];
    const contactButton = documentRef.querySelector(".js-contact-btn");
    const form = documentRef.querySelector(".js-contact-modal > form");
    const inputs = [...documentRef.querySelectorAll(".js-contact-input")];
    const modal = documentRef.querySelector(".js-contact-modal");
    const navigation = documentRef.querySelector(".js-mobile-navigation");
    const success = documentRef.querySelector(".js-contact-success");
    const successClose = documentRef.querySelector(".js-contact-success-close");
    const status = documentRef.querySelector(".js-contact-status");
    const currentYear = documentRef.querySelector(".js-current-year");

    currentYear.textContent = String(new Date().getFullYear());

    burger.addEventListener("click", () => {
        navigation.classList.remove(HIDDEN_CLASS);
        burger.setAttribute("aria-expanded", "true");
    });

    navigation.addEventListener("click", () => {
        navigation.classList.add(HIDDEN_CLASS);
        burger.setAttribute("aria-expanded", "false");
    });

    contactButton.addEventListener("click", () => {
        modal.classList.remove(HIDDEN_CLASS);
        form.querySelector('[name="email"]').focus();
    });

    const resetAndClose = (event) => {
        event.preventDefault();
        modal.classList.add(HIDDEN_CLASS);
        form.reset();
        setHidden(inputs, false);
        inputs.forEach((input) => { input.disabled = false; });
        success.classList.add(HIDDEN_CLASS);
        successClose.classList.add(HIDDEN_CLASS);
        status.classList.add(HIDDEN_CLASS);
        status.textContent = "";
    };

    closeButtons.forEach((button) => button.addEventListener("click", resetAndClose));

    form.addEventListener("submit", (event) => {
        event.preventDefault();
        const payload = Object.fromEntries(new FormData(form));

        inputs.forEach((input) => { input.disabled = true; });
        setHidden(inputs, true);
        success.classList.remove(HIDDEN_CLASS);
        successClose.classList.remove(HIDDEN_CLASS);
        status.textContent = "Message sent.";
        status.classList.remove(HIDDEN_CLASS);

        try {
            const request = fetchImpl(form.action, {
                method: form.method,
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(payload),
            });
            void Promise.resolve(request).catch(() => {});
        } catch {}
    });

    return { form, modal, navigation };
}
