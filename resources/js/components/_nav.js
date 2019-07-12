import breakpoints from '../main/breakpoints';
import dom from '../main/dom';

// Component Events
if (document.querySelector('.toggleMenu') !== null) {
    document.querySelector('.toggleMenu').addEventListener('click', displayNav);
}


// Component Methods
function displayNav(event) {
    $('.navbar_menu--hidden').toggleClass('navbar_menu--display');
}

let nav = {
    init: () => {

    }
}

if (document.querySelector('.navbar' !== null)) {
    nav.init();
}