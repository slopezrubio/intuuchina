import MediaQueries from '../main/breakpoints';
import DOM from '../main/dom';
import UI from '../main/UI';

let footer = {
    init: function() {
        window.addEventListener('load', footer.setup);
        window.addEventListener('resize', function() {
            footer.toggleSwitch();
        });
    },
    form: document.querySelector('.footer_contact_form'),
    setup: () => {
        if (footer.hasErrorsMessages(footer.form)) {
            footer.setViewport();
        }
        footer.toggleSwitch();
    },
    toggleSwitch: () => {
        let switchInput = document.querySelector('#terms').parentElement.parentElement !== null
            ? document.querySelector('#terms').parentElement.parentElement
            : null;

        let className = UI.getInputClass(switchInput);

        if (className !== null) {
            DOM.toggleSingleClass(switchInput, className);
        }


        // if (footer.getScreenSize()[0] > breakpoints.widths.largeDevices) {
        //     if (document.querySelector('.checkbox_input') === null) {
        //         dom.toggleClass(switchInput, 'switch_input', 'checkbox_input');
        //     }
        // }
        //
        // if (footer.getScreenSize()[0] <= breakpoints.widths.largeDevices) {
        //     if (document.querySelector('.switch_input') === null) {
        //         dom.toggleClass(switchInput, 'switch_input', 'checkbox_input');
        //     }
        // }
    },
    hasErrorsMessages: function(parent) {
        if ($(parent).find('.invalid-feedback', '.is-invalid').length > 0) {
            return true;
        }

        return false;
        // let fields = footer.form.querySelectorAll('.col-xs-10');
        // for (let i = 0; i < fields.length && errors === false; i++) {
        //     if (fields[i].querySelector('.is-invalid') !== null) {
        //         errors = true;
        //     }
        // }
        //
        // if (errors) {
        //     return true;
        // }
        // return false;
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