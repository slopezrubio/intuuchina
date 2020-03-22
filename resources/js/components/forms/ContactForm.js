import { FormFactory } from "../../factories/FormsFactory";
import browser from "../../facades/browser";

function ContactForm(options) {
    this.fields = {
        name: $('#contact-name'),
        terms: $('#contact-terms').parents('.c-switch-input')[0],
    };

    this.toggleCheckableInput = function() {
        $(this.fields.terms).toggleClass('c-switch-input c-checkbox-input c-checkbox-input--footer');
        $(this.fields.terms).find('label:first-child').toggleClass('c-switch-input__label c-checkbox-input__label');
        $(this.fields.terms).find('.wrapper').toggleClass('c-switch-input__wrapper c-checkbox-input__wrapper');
    };
}

export var contactFormFactory = new FormFactory();

export default ContactForm;