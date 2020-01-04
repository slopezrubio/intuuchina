var Forms = (function() {
    var instance;

    function init() {
        var _preventInputFocus = function(event) {
            if (!window.__cfRLUnblockHandlers) return false;
        };

        return {
            // Disables the custom inputs of the form (All but the Stripe inputs)
            disableFormInputs: function(form, disabled = true) {
                $(form).filter(':input:not(.__PrivateStripeElement-input)').each(function() {
                    $(this).attr("disabled", disabled);
                });
            },

            showElement: (element) => {
                element.classList.remove('hidden');
                element.setAttribute('aria-hidden', false);
            },

            hideElement: (element) => {
                element.classList.add('hidden');
                element.setAttribute('aria-hidden', true);
            },

            // Disables all the Stripe inputs of the form.
            disableStripeInputs: function(stripeElements, disabled = true) {
                $(stripeElements._elements).each(function() {
                    let stripeInput = $(this)[0];
                    stripeInput.update({
                        disabled: disabled
                    });
                });
            },

            getFormToken: function(form) {
                return form.querySelector('input[type="hidden"')
            },

            toggleDisablingForm: function(form) {
                let submitButton = form.querySelector('button[type=submit]');

                console.log(submitButton);
                console.log(form);

                $(submitButton).one('click', (event) => {
                    if (submitButton.getAttribute('disabled') !== true) {
                        $(this).prop('disabled', true);
                        $(form).submit(false);
                    } else {
                        $(this).prop('disabled', false);
                        $(form).submit(true);
                    }
                });
            },

            preventDoubleClick: function(form) {
                let submitButton = form.querySelector('button[type=submit]');

                $(submitButton).one('click', function(event) {
                    $(this).prop('disabled', true);
                    setTimeout(() => {
                        $(this).prop('disabled', false);
                    }, 1000);
                });
            },

            toggleInputs: function(value, elements) {
                Object.keys(elements).forEach((key) => {
                    let element = elements[key][0];
                    let input = element.localName !== 'input' ? element.querySelector('input') : element;
                    $(input).prop('disabled', true);
                    this.hideElement(element);

                    if (key === value) {
                        $(input).prop('disabled', false);
                        this.showElement(element);
                    }
                })
            }
        }
    }

    return {
        getInstance: function() {
            if (!instance) {
                instance = init();
            }

            return instance;
        }
    }
})();

export default Forms.getInstance();