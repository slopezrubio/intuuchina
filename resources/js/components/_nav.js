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
        nav.setup();
    },
    setup: () => {
        window.addEventListener('load', function() {
            if (nav.hasErrorsMessages(nav.modalForm)) {
                nav.showModal();
            };
        })
    },
    modalForm: document.querySelector('.modal__form') !== null ?  document.querySelector('.modal__form') : null,
    hasErrorsMessages: (parent) => {
        if ($(parent).find('.is-invalid').length > 0) {
            return true;
        }

        return false;
    },
    showModal: () => {
        $('#loginModal').modal();
    }
}

if (document.getElementsByTagName('nav') !== null) {
    nav.init();
}