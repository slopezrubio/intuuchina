import { contactFormFactory } from "./forms/ContactForm";
import browser from "../facades/browser";


var footer = (function() {
    var el = document.querySelector('.footer');
    var contactForm = null;

    var init = function() {
        setListeners();
    };

    var setContactForm = function() {
        contactForm = new contactFormFactory.createForm({
            type: 'contact',
            form: el.querySelector('.contact-form')
        });

        if (contactForm.hasErrorMessages()) {
            contactForm.focusFirstInvalidField();
            window.scrollBy(0, contactForm.el.getBoundingClientRect().top);
        };
    };

    var setResponsiveness = function() {
        if ((browser.matchesGivenBreakpoint('footer.checkbox')
            && contactForm.fields.terms.classList.contains('c-switch-input'))
            || (!browser.matchesGivenBreakpoint('footer.checkbox')
            && contactForm.fields.terms.classList.contains('c-checkbox-input'))) {
            contactForm.toggleCheckableInput();
        }
    };

    var setListeners = function() {
        if (el !== null) {
            window.addEventListener('load', (e) => {
                setContactForm();
                setResponsiveness();
            });

            window.addEventListener('resize', (e) => {
                setResponsiveness();
            })
        }
    };

    init();
})();