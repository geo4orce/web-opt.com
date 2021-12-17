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
