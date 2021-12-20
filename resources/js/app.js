const burger = document.querySelector('.js-burger');
const close = document.querySelectorAll('.js-contact-close');
const contact = document.querySelector('.js-contact-btn');
const form = document.querySelector('.js-contact-modal > form');
const inputs = document.querySelectorAll('.js-contact-input');
const modal = document.querySelector('.js-contact-modal');
const nav = document.querySelector('.js-mobile-navigation');
const success = document.querySelector('.js-contact-success');
const successClose = document.querySelector('.js-contact-success + .js-contact-close');

// open burger
burger.addEventListener('click', () => {
    console.debug('open burger');
    nav.classList.remove('hidden');
});

// close burger
nav.addEventListener('click', () => {
    console.debug('close burger');
    nav.classList.add('hidden');
});

// contact modal open
contact.addEventListener('click', () => {
    console.debug('contact modal open');
    modal.classList.remove('hidden');
});

// contact modal close
close.forEach(i => {
    i.addEventListener('click', (e) => {
        console.debug('contact modal reset and close', e.target);
        e.preventDefault();
        modal.classList.add('hidden');
        form.reset();

        // show all inputs
        inputs.forEach(i => {
            i.classList.remove('hidden');
        });

        // hide success
        success.classList.add('hidden');
        successClose.classList.add('hidden');
    });
});

// contact form submit
form.addEventListener('submit', (e) => {
    const formData = new FormData(form);
    console.debug('contact form submit', ...formData);
    e.preventDefault();

    // hide all inputs
    inputs.forEach(i => {
        i.classList.add('hidden');
    });

    // show success
    success.classList.remove('hidden');
    successClose.classList.remove('hidden');

    // POST
    fetch(form.action, {
        method: form.method,
        body: formData,
    })
        .then(response => response.json())
        .then(json => console.log('response', json));
});
