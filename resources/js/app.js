const burger = document.querySelector('.js-burger');
const nav = document.querySelector('.js-mobile-navigation');

// open burger
burger.addEventListener('click', () => {
    nav.classList.remove('hidden');
});

// close burger
nav.addEventListener('click', () => {
    nav.classList.add('hidden');
});

const contact = document.querySelector('.js-contact-btn');
const modal = document.querySelector('.js-contact-modal');
const close = document.querySelector('.js-contact-close');

// contact modal
contact.addEventListener('click', () => {
    modal.classList.remove('hidden');
});

// contact close
close.addEventListener('click', () => {
    modal.classList.add('hidden');
});
