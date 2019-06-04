let footer = {
    init: function() {
        window.addEventListener('load', footer.setup);
    },
    element: document.getElementsByTagName('footer'),
    form: document.querySelector('.footer_contact_form'),
    setup: () => {
        if (footer.hasErrorsMessages()) {
            footer.setViewport();
        }
    },
    hasErrorsMessages: function() {
        let errors = false;
        let fields = footer.form.querySelectorAll('.col-xs-10');
        console.log(fields[0]);
        for (let i = 0; i < fields.length && errors === false; i++) {
            if (fields[i].querySelector('.invalid-feedback') !== null) {
                errors = true;
            }
        }

        if (errors) {
            return true;
        }
        return false;
    },
    setViewport: () => {
        window.scrollBy(0, footer.element[0].offsetTop);
    }
};

if (document.querySelector('.footer') !== null) {
    footer.init();
}