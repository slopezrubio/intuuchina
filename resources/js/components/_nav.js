import breakpoints from '../main/breakpoints';
import dom from '../main/dom';

let nav = {
    init: () => {
        nav.setup();
    },
    setup: () => {
        window.addEventListener('load', function() {
            if (nav.hasErrorsMessages(nav.modalForm)) {
                nav.showModal();
            };
        });

        for (let i=0; i < nav.accordionSubmenus.length; i++) {
            nav.accordionSubmenus[i].addEventListener('mouseover', nav.highlightItem, true);
            nav.accordionSubmenus[i].addEventListener('mouseout', nav.highlightItem, true);
        }
    },
    modalForm: document.querySelector('.modal__form') !== null ?  document.querySelector('.modal__form') : null,
    accordionSubmenus:  document.querySelectorAll('.accordion_submenu') !== null ?  document.querySelectorAll('.accordion_submenu') : null,
    highlightItem: function(event) {
        if (window.innerWidth < breakpoints.widths.largeDevices[0]) {
            let pattern = /\s?show\s?/;
            if (this.getAttribute('class').match(pattern)) {
                dom.toggleSingleClass(this.parentElement, 'reverse-colours');
            }
        }
    },
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