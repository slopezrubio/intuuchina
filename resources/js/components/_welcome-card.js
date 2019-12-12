const axios = require('axios');

import domObserver from "../main/domObserver.js";
import dom from '../main/dom';
import api from '../main/api';

let welcomeCard = {
    init: function() {
        window.addEventListener('DOMContentLoaded', function() {
            domObserver(welcomeCard.dialogBoxContainer().parentElement, welcomeCard.update);
        });
        welcomeCard.setup();
    },
    dialogBoxContainer: function() { return document.querySelector('#dialog-box') ? document.querySelector('#dialog-box') : null },
    update: function() {
        welcomeCard.setup();
    },
    buttons: {
        continue: {
            el: function() { return document.querySelector('#continue') ? document.querySelector('#continue') : null }
        }
    },
    forms: {
        confirm: {
            el: function() { return document.querySelector('#confirm') ? document.querySelector('#confirm') : null }
        },
        checkout: {
            el: function() { return document.querySelector('#checkout') ? document.querySelector('#checkout') : null }
        }
    },
    elements: {
        header: function() { return document.querySelector('#welcome') ? document.querySelector('#welcome') : null },
        stripe: null,
    },
    rates: null,
    paymentAmount: null,
    changeLoadingState: function(element, display, text = 'Loading...') {
        let spinner = element.querySelector('.spinner-border');

        if (display) {
            spinner.classList.remove('hidden')
            spinner.previousElementSibling.textContent = text;
        } else {
            spinner.classList.add('hidden');
            spinner.previousElementSibling.textContent = text;
        }
    },
    setup: async function() {
        if (welcomeCard.forms.confirm.el() !== null) {
            welcomeCard.forms.confirm.el().addEventListener('submit', async function (event) {
                event.preventDefault();
                let url = event.target.getAttribute('action');
                let data = {
                    _token : welcomeCard.forms.confirm.el().querySelector('input[type="hidden"')
                };
                let dialogBox = await api.confirm(url, data);
                welcomeCard.replaceDialog(dialogBox);
            });
        }

        if (welcomeCard.buttons.continue.el() !== null) {
            welcomeCard.buttons.continue.el().addEventListener('click', async function (event) {
                event.preventDefault();
                // Get the text inside the button
                let defaultText = event.target.textContent;

                // Sets the loader inside the button
                welcomeCard.changeLoadingState(event.target.parentElement, true);

                // Gets the URL and make a request to the API
                let url = window.location.protocol + '//' + window.location.hostname + '/payment-details';
                let paymentFeeDialog = await api.continue(url);

                // Hides the loader once again
                welcomeCard.changeLoadingState(event.target.parentElement, false, defaultText);

                // Replace dialog box
                welcomeCard.replaceDialog(paymentFeeDialog);
            })
        }

        if (welcomeCard.forms.checkout.el() !== null) {
            if (!welcomeCard.isStripeLoaded()) {
                welcomeCard.setStripeElements();
                welcomeCard.rates = await welcomeCard.fetchRates();

            }
        }
    },
    isStripeLoaded: function() {
        return welcomeCard.forms.checkout.el().querySelector('#card-number').childElementCount > 0;
    },
    /**
     * Replace the existing element with ID #dialog-box
     * for the one passed as an argument.
     *
     * @param newDialogBox
     */
    replaceDialog: function(newDialogBox) {
        let container = welcomeCard.dialogBoxContainer().parentElement;
        $(welcomeCard.dialogBoxContainer()).empty();
        $(container).html(newDialogBox);
    },
    handleServerErrorField: async function(field, element) {
        let errors = await api.validate(field);

        //const displayError =  document.getElementById(field.name + '-errors');

        if (errors !== null) {
            welcomeCard.displayInputFieldError(field.name, errors['value'][0]);
        } else {
            welcomeCard.removeInputFieldError(field.name);
        }
    },
    setStripeElements: function() {
        welcomeCard.elements.stripe = stripe.elements({
            fonts: [{
                cssSrc: "https://fonts.googleapis.com/css?family=Montserrat"
            }],
        });

        // Holdername element
        var cardHolderName = document.getElementById('card_holder_name');

        // Phone Number element
        var phoneNumber = document.getElementById('phone_number');

        // Email payer Element
        var cardEmailPayer = document.getElementById('email');

        // Stripe Card Number element
        var cardNumber = welcomeCard.elements.stripe.create('cardNumber');
        cardNumber.mount('#card-number');

        // Stripe Card Expiry element
        var cardExpiry = welcomeCard.elements.stripe.create('cardExpiry', {
            placeholder: 'MM / YY'
        });
        cardExpiry.mount('#card-expiry');

        // Stripe Card CVC element
        var cvc = welcomeCard.elements.stripe.create('cardCvc', {
            placeholder: '123'
        });
        cvc.mount('#card-cvc');

        var paymentCurrency = document.getElementById('payment-currency');

        welcomeCard.setPaymentAmount(document.querySelector('#checkout-button-sku_GDHDkOPWtjGF2w').querySelector('span').getAttribute('data-value'));

        // Payment Request Options
        var paymentRequest = stripe.paymentRequest({
            country: 'ES',
            currency: paymentCurrency.value,
            total: {
                amount: 3000,
                label: 'Application Fee',
            },
            requestPayerPhone: true,
            requestPayerEmail: true,
        });

        welcomeCard.setStripePaymentRequestButton(welcomeCard.elements.stripe, paymentRequest);

        /**
         * STRIPE ELEMENTS EVENTS
         */
        cardHolderName.addEventListener('change', (event) => {
            let field = {
                value: event.target.value,
                name: event.target.getAttribute('name'),
                validators: [
                    'ValidName'
                ]
            };

            welcomeCard.handleServerErrorField(field, event.target)
        });

        phoneNumber.addEventListener('change', (event) => {
            let field = {
                value: event.target.value,
                name: event.target.getAttribute('name'),
                validators: [
                    'required',
                    'numeric',
                    'PhoneNumber'
                ]
            }

            welcomeCard.handleServerErrorField(field, event.target);
        });

        cardEmailPayer.addEventListener('change', (event) => {
            let field = {
                value: event.target.value,
                name: event.target.getAttribute('name'),
                validators: 'required|email'
            };

            welcomeCard.handleServerErrorField(field, event.target);
        });

        cardNumber.addEventListener('change', ({error}) => {
            const displayError = document.getElementById('card-number-errors');
            welcomeCard.displayStripeErrors(displayError, error)
        });

        cvc.addEventListener('change', ({error}) => {
            const displayError = document.getElementById('cvc-errors');
            welcomeCard.displayStripeErrors(displayError, error)
        });

        cardExpiry.addEventListener('change', ({error}) => {
            const displayError = document.getElementById('card-expiry-errors');
            welcomeCard.displayStripeErrors(displayError, error)
        });


        paymentCurrency.addEventListener('change', async (e) => {
            var submitButtonText = $('#checkout-button-sku_GDHDkOPWtjGF2w > span')[0];

            // Get only the text inside the button without the currency symbol and the value.
            var text = $(submitButtonText).text().match(new RegExp(/^([A-Z]?[\s\D][^A-Z\u00A5-\u20BF\u0024\u00A3\d.]+)/))[0];

            var valueConverted = await welcomeCard.currencyExchange(parseFloat(submitButtonText.getAttribute('data-value'))  / 100, e.target.value);

            welcomeCard.setPaymentAmount(valueConverted, e.target.value);
            valueConverted = parseFloat(valueConverted).toLocaleString(document.documentElement.lang, {
                style: 'currency',
                currency: e.target.value.toUpperCase()
            });

            $(submitButtonText).text(text + valueConverted)
        });

        $('#checkout-button-sku_GDHDkOPWtjGF2w').on('click', async (e) => {
            e.preventDefault();

            // Saves the text inside the button to reusing it afterwards.
            let defaultText = e.target.textContent;

            // Only for testing
            // console.log(api.getHostName() + '/payment-successful');
            // let newDialog = await api.continue(api.getHostName() + '/payment-successful');
            // welcomeCard.replaceDialog(newDialog);
            // return;

            // Sets the loader inside the checkout button.
            welcomeCard.changeLoadingState(e.target.parentElement, true);

            // Disables all inputs of the form.
            welcomeCard.disableAllInputs('checkout', true);

            const billingDetails = await welcomeCard.validateBillingDetails({
                type : 'billing_details',
                billing_details : {
                    card_holder_name: cardHolderName.value,
                    email: document.querySelector('#email').value,
                    phone_number: phoneNumber.value,
                }
            });

            // Check if the billing details have been validated.
            if (billingDetails !== null) {
                /*
                 * Creates a paymentMethod to send its ID to the server so that
                 * the user can be charged by the Stripe PHP API.
                 */
                const { paymentMethod, error } = await stripe.createPaymentMethod(
                    'card', cardNumber, {
                        billing_details: billingDetails
                    }
                );

                // Check the form for errors.
                if (error) {
                    welcomeCard.displayInputFieldError('submit', error.message);
                } else {
                    /**
                     * If no errors found it, gathers the information needed to Stripe PHP API
                     * so the payment can be applied in the server.
                     */
                    let data = {
                        _token: welcomeCard.forms.checkout.el().querySelector('input[type="hidden"').value,
                        payment_method: paymentMethod.id,
                        card_holder_name: paymentMethod.billing_details.name,
                        email: paymentMethod.billing_details.email,
                        phone_number: paymentMethod.billing_details.phone,
                        currency: document.getElementById('payment-currency').value,
                        amount: welcomeCard.paymentAmount,
                    };

                    /*
                     * Sends the information needed along the Payment Method ID.
                     */
                    api.sendPaymentMethod(data)
                        .then(function(result) {
                            let error = result.data.error;
                            if (error) {

                                /*
                                 * Displays the error coming from the server according to the field or
                                 * parameter the error is related to.
                                 */
                                welcomeCard.displayInputFieldError(error.field, error.message);

                            } else {

                                /*
                                 * If the user do not get redirected by the server means:
                                 *
                                 * 1) The payment has failed and therefore an error response
                                 * has been received from the server.
                                 *
                                 * OR
                                 *
                                 * 2) The Payment Intent needs a step further in the authentication
                                 * process and gives back the Payment Intent Status
                                 * as to let the user handle it. Perhaps their bank account asked
                                 * him for a notification push message through his mobile phone or
                                 * email
                                 */

                                // In both cases the returned data is sent to a handler.
                                welcomeCard.handleServerResponse(result.data);

                                // Enables again the inputs of the checkout form.
                                welcomeCard.disableAllInputs('checkout', false);

                                // If not, stops and hides the loader inside the checkout button.
                                welcomeCard.changeLoadingState(e.target.parentElement, false, defaultText);
                            }
                        })

                    // Only when JavaScript is disabled
                    // document.querySelector('#payment-method').value = paymentMethod.id;
                    // welcomeCard.forms.checkout.el().submit();
                }
            }

            /**
             * CHECKOUT PAYMENT PROCESS (optional)
             */
            // let cancelUrl = window.location.protocol + '//' + window.location.hostname + '/home';
            // let successUrl = welcomeCard.forms.checkout.el().getAttribute('action');
            //
            // welcomeCard.redirectToCheckout(successUrl, cancelUrl);
        });
    },
    disableAllInputs: (formId, disabled) => {
        /**
         * Disables all the inputs of the given form
         */

        // Disables the custom inputs of the form (All but the Stripe inputs)
        $('#' + formId + ' :input:not(.__PrivateStripeElement-input)').each(function() {
            $(this).attr("disabled", disabled);
        });

        // Disables all the Stripe inputs of the form.
        $(welcomeCard.elements.stripe._elements).each(function() {
            let stripeInput = $(this)[0];
            stripeInput.update({
                disabled: disabled
            });
        });
    },
    setPaymentAmount: function(value, currency = 'EUR') {

        if (welcomeCard.paymentAmount !== null) {
            // Check if the given currency is a zero-decimal currency
            let multiplier = currencies[currency].decimal_digits > 0
                ? Math.pow(10, currencies[currency].decimal_digits) : 1;

            // Remove decimals to set the amount in the less unit of measure (cents)
            welcomeCard.paymentAmount = (value * multiplier).toFixed(0);
            return true;
        }

        welcomeCard.paymentAmount = value;
    },
    displayStripeErrors: function(element, error) {
        if (error) {
            element.textContent = error.message;
            element.style.display = 'block';
        } else {
            element.textContent = '';
            element.style.display = 'none';
        }
    },
    handleServerResponse: function(response) {
        /*
         * Gets the server response and checks whether the payment has failed or
         * else, the Payment Intent needs another step of authentication.
         */
        if (response.error) {

            welcomeCard.displayInputFieldError('submit', error.message);

        } else if (response.requires_action) {

            /*
             * Triggers the next authentication step or action where the user is likely
             * to be required for a 3D Secure (mandatory by the Strong Customer Authentication)
             * regulation in Europe.
             */
            stripe.handleCardAction(response.payment_intent_client_secret)
            /*
                 * Sends the response to another handler which will try
                 * to confirm the payment once again.
                 */
                .then(welcomeCard.handleStripeJsResult);
        } else {
            /*
             * The payment has been successfully created and shows a confirmation dialog to the user.
             */
            welcomeCard.replaceDialog(response);
        }
    },
    /**
     * Receives the response of the «stripe.handleCardAction» method. If the Payment Intent
     * has sent an error it will show the error message just above the submit button. Otherwise
     * it will sent the Payment Method Intent ID to the server to finally complete and
     * confirm the payment linked to the Payment Method sent previously.
     *
     * @param result
     */
    handleStripeJsResult: function(result) {
        if (result.error) {
            var displayError = document.getElementById('submit-errors');
            displayError.textContent = result.error.message;
            displayError.style.display = 'block';
        } else {
            let data = {
                _token: welcomeCard.forms.checkout.el().querySelector('input[type="hidden"').value,
                payment_intent_id: result.paymentIntent.id
            }

            api.sendPaymentMethod(data).
                then(function(confirmResult) {
                    return confirmResult.data;
                })
                .then(function(view) {
                    welcomeCard.handleServerResponse(view);
                });
        }
    },
    fetchRates: async function() {
        let url = 'https://api.exchangeratesapi.io/latest?base=EUR';

        try {
            const response = await axios({
                method: 'get',
                url: url
            });

            return await response.data;
        } catch(error) {
            console.log(error);
        }
    },
    currencyExchange: async function(value, to, from = 'EUR') {
        if (to.toUpperCase() !== 'EUR') {
            value *= welcomeCard.rates.rates[to.toUpperCase()];
        }

        return value;
    },
    validateBillingDetails: async function(billing) {
        const errors = await api.validateObject(billing);

        if (errors) {
            welcomeCard.handleErrorFields(Object.keys(errors), errors);
            return null
        }

        return {
            name: billing.billing_details.card_holder_name,
            email: billing.billing_details.email,
            phone: billing.billing_details.phone_number
        }
    },
    /*
     * Displays the given errors to the given fields.
     */
    handleErrorFields: function(fields, errors) {
        if (Array.isArray(fields)) {
            fields.forEach(function(field) {
               welcomeCard.displayInputFieldError(field, errors[field][0])
            })
        }
    },
    displayInputFieldError: function(field, error) {
        var displayError = document.getElementById(field + '-errors') ? document.getElementById(field + '-errors') : 'submit-errors';
        var input = document.getElementById(field) ? document.getElementById(field) : document.getElementById('card-' + field);
        if (input !== null) {
            input.classList.add('is-invalid');
        }
        displayError.style.display = 'block';
        displayError.textContent = error;
    },
    removeInputFieldError: function(field) {
        var displayError = document.getElementById(field + '-errors');
        var input = document.getElementById(field);
        displayError.style.display = 'none';
        if (input !== null) {
            input.classList.remove('is-invalid');
        }
    },
    redirectToCheckout: function(successUrl, cancelUrl) {
        stripe.redirectToCheckout({
            items: [{sku: 'sku_GDHDkOPWtjGF2w', quantity: 1}],

            // Do not rely on the redirect to the successUrl for fulfilling
            // purchases, customers may not always reach the success_url after
            // a successful payment.
            // Instead use one of the strategies described in
            // https://stripe.com/docs/payments/checkout/fulfillment
            successUrl: successUrl,
            cancelUrl: cancelUrl
        })
            .then(function (result) {
                if (result.error) {
                    // If `redirectToCheckout` fails due to a browser or network
                    // error, display the localized error message to your customer.
                    var displayError = document.getElementById('error-message');
                    displayError.textContent = result.error.message;
                }
            });
    },
    setStripePaymentRequestButton: function(elements, paymentRequest) {
        var paymentRequestButton = elements.create('paymentRequestButton', {
            paymentRequest: paymentRequest,
        });

        paymentRequest.canMakePayment().then(function(result) {
            if (result) {
                paymentRequestButton.mount('#payment-request-button');
            } else {
                document.getElementById('payment-request-button').style.display = 'none';
                document.getElementById('checkout-button-sku_GDHDkOPWtjGF2w').parentElement.style.display = 'block';
            }
        });

        /*paymentRequest.on('paymentmethod', function(e) {
            stripe.confirmCardPayment(
                clientSecret,
                {payment_method: e.paymentMethod.id},
                {handleActions: false}
            ).then(function(confirmResult) {
                if (confirmResult.error) {
                    e.complete('failed');
                } else {
                    e.complete('success')
                    stripe.confirmCardPayment(clientSecret).then(function(result) {

                    })
                }
            })
        });*/
    }
}

if (document.querySelector('.user-card')) {
    welcomeCard.init();
}

