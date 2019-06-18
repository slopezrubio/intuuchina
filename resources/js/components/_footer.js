import breakpoints from '../main/breakpoints';
import dom from '../main/dom';

let footer = {
    init: function() {
        window.addEventListener('load', footer.setup);
        window.addEventListener('resize', function() {
            footer.setSwitch();
        });
    },
    form: document.querySelector('.footer_contact_form'),
    setup: () => {
        if (footer.hasErrorsMessages()) {
            footer.setViewport();
        }
        footer.setSwitch();
    },
    getScreenSize: () => {
        let screenSize = [];
        screenSize.push(window.innerWidth, window.innerHeight);
        return screenSize;
    },
    setSwitch: () => {
        let switchInput = document.querySelector('.switch_input') !== null
            ? document.querySelector('.switch_input')
            : document.querySelector('.checkbox_input');

        if (footer.getScreenSize()[0] > breakpoints.widths.largeDevices) {
            if (document.querySelector('.checkbox_input') === null) {
                dom.toggleClass(switchInput, 'switch_input', 'checkbox_input');
            }
        }

        if (footer.getScreenSize()[0] <= breakpoints.widths.largeDevices) {
            if (document.querySelector('.switch_input') === null) {
                dom.toggleClass(switchInput, 'switch_input', 'checkbox_input');
            }
        }
    },
    hasErrorsMessages: function() {
        let errors = false;
        let fields = footer.form.querySelectorAll('.col-xs-10');
        for (let i = 0; i < fields.length && errors === false; i++) {
            if (fields[i].querySelector('.is-invalid') !== null) {
                errors = true;
            }
        }

        if (errors) {
            return true;
        }
        return false;
    },
    setViewport: () => {
        /*
         * Obtiene la diferencia de scroll entre la del usuario y la del formulario
         * del pie de página.
         */
        let scrollToForm = footer.form.offsetTop - window.scrollY;

        /*
         * Realiza el scroll hasta el formulario de pie de página.
         */
        window.scrollBy(0, scrollToForm);
    },
};

if (document.querySelector('.footer') !== null) {
    footer.init();
}