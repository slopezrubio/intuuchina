import ContactForm from '../components/forms/ContactForm';
import EditOfferForm from '../components/forms/EditOfferForm';
import CreateOfferForm from '../components/forms/CreateOfferForm';
import SignUpForm from '../components/forms/SignUpForm';
import ProceedPaymentForm from '../components/forms/ProceedPaymentForm';
import PaymentForm from '../components/forms/PaymentForm';
import LoginForm from '../components/forms/LoginForm';

import UI from '../main/UI';

import dom from '../facades/dom';
import api from '../facades/api';

export function FormFactory() {}

FormFactory.prototype.formClass = null;

FormFactory.prototype.createForm = function(options) {
    switch(options.type) {
        case 'contact':
            this.formClass = ContactForm;
            break;
        case 'sign-up':
            this.formClass = SignUpForm;
            break;
        case 'proceed-payment':
            this.formClass = ProceedPaymentForm;
            break;
        case 'payment':
            this.formClass = PaymentForm;
            break;
        case 'login':
            this.formClass = LoginForm;
            break;
        case 'create-offer':
            this.formClass = CreateOfferForm;
            break;
        case 'edit-offer':
            this.formClass = EditOfferForm;
            break;
    }

    let formClass = new this.formClass(options);

    formClass.el = options.form;

    formClass.disabled = false;

    formClass.hasErrorMessages = function(element = formClass.el) {
        return $(element).find('.invalid-feedback').length > 0 && $(element).find('.is-invalid').length > 0;
    };

    formClass.isInvalidField = function(field) {
        return $(field).hasClass('is-invalid');
    };

    formClass.focusFirstInvalidField = function() {
        Object.keys(formClass.fields).forEach(function(key) {
            if (formClass.hasErrorMessages(formClass.fields[key])
                || formClass.isInvalidField(formClass.fields[key])) {
                formClass.fields[key].focus();
                return formClass;
            }
        });

        return formClass;
    };

    formClass.getActionUrl = function() {
        return formClass.el.getAttribute('action');
    };

    formClass.toggleLoadingState = function() {
        UI.toggleSpinnerButtonState(formClass.getSubmitInput());
        formClass.disable(!formClass.isDisabled());
        return formClass;
    };

    formClass.getSubmitInput = function() {
        return $(formClass.el).find("button[type='submit']")[0];
    };

    formClass.toggleInputs = function(elements) {
        elements.forEach((element) => {
            let input = element.localName !== 'input' ? element.querySelector('input') : element;

            if (!$(input).hasClass('form-group')) {
                $($(input).parents('.form-group')[0]).toggleClass('hidden');
            }
        });
    };

    formClass.mountWYSIWYGEditor = function() {
        if (this.editor !== undefined) {
            return new Quill(this.el.querySelector('.editor'), {
                modules: {
                    toolbar: [
                        [{ header: [3, 4, 5, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }, 'blockquote'],
                        [{ 'indent' : '-1'}, { 'indent' : '+1'}, 'link', 'code-block']
                    ]
                },
                placeholder: this.editor.getAttribute('data-value'),
                theme: 'snow'
            });
        }
    };

    formClass.isDisabled = function() {
        return formClass.disabled;
    };

    formClass.validateField = async function(field, validators) {
        let validationObject = {
            name: field.getAttribute('name'),
            value: field.value,
            validators: validators
        };

        let response = await api.validate(validationObject);

        if (response.errors) {
            let errors = response.errors.value;

            errors.forEach((error) => {
                this.displayFieldError(field, error);
            });

            return this;
        }

        this.removeFieldError(field);
    };

    formClass.displayFieldError = function(field, message) {
        $(field).addClass('is-invalid');
        $($(field).parents('.form-group')[0]).find('.invalid-feedback').text(message).css('display', 'block');
    };

    formClass.removeFieldError = function(field) {
        if ($(field).hasClass('is-invalid')) {
            $(field).removeClass('is-invalid');
        }
        $($(field).parents('.form-group')[0]).find('.invalid-feedback').empty();
    };

    formClass.disable = function(disabled = true) {
        $('input:not(.__PrivateStripeElement-input), select, button, fieldset', formClass.el).each((index, element) => {
            $(element).prop('disabled', disabled);
        });

        formClass.disabled = !formClass.isDisabled();
    };

    formClass.previewUploadedFiles = function() {
        let previews = formClass.el.querySelectorAll('.c-file-input__img-preview');

        for (let i = 0; i <= previews.length; i++) {
            let input = $(previews[i]).next('.c-file-input');
            console.log(input);

            $(input).on('click touchstart', function() {
                $(this).val('');
            });

            $(input).change(function(ev) {
                console.log(ev.target.files.item(0));
                $(previews[i]).attr('src', URL.createObjectURL(ev.target.files.item(0)));
            });
        }

        return formClass;
    };

    return formClass;
};