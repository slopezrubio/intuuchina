const axios = require('axios');

import Forms from '../main/Forms';
import Money from "../main/Money";
import UI from '../main/UI';
import domObserver from '../main/domObserver.js';
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
        payment: {
            el: function() { return document.querySelector('#payment') ? document.querySelector('#payment') : null }
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
    minimumHours: null,
    minimumStaying: null,
    getPricePerUnit: function() {
        return document.querySelector('#checkout-button-sku_GDHDkOPWtjGF2w').querySelector('span').getAttribute('data-value') / 100;
    },
    setPricePerUnit: function(price) {
        price = (price * 100).toString();
        document.querySelector('#checkout-button-sku_GDHDkOPWtjGF2w').querySelector('span').setAttribute('data-value', price);
    },
    set: function(property, value) {
        welcomeCard[property] = value;
    },
    setup: async function() {
        if (welcomeCard.forms.payment.el() !== null) {

            Forms.preventDoubleClick(welcomeCard.forms.payment.el());

            welcomeCard.forms.payment.el().addEventListener('submit', async function (event) {
                event.preventDefault();

                // Sets the loader inside the button
                UI.changeLoadingButtonState(event.target);

                // Gets the URL and make a request to the API
                let urlPaymentForm = event.target.getAttribute('action');

                let paymentFeeDialog = await api.getDialog(urlPaymentForm, Forms.getFormToken(event.target));

                // Hides the loader once again
                UI.changeLoadingButtonState(event.target);

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
    isCourseSelected: function() {
        return document.getElementById('study');
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

        if (errors !== null) {
            welcomeCard.displayInputFieldError(field.name, errors['value'][0]);
        } else {
            welcomeCard.removeInputFieldError(field.name);
        }

        return errors;
    },
    updatePaymentButton: function(value, currency) {
        var submitButtonText = $('#checkout-button-sku_GDHDkOPWtjGF2w > span')[0];

        // Get only the text inside the button without the currency symbol and the value.
        var text = $(submitButtonText).text().match(new RegExp(/^([A-Z]?[\s\D][^A-Z\u00A5-\u20BF\u0024\u00A3\d.]+)/))[0];

        value = parseFloat(value).toLocaleString(document.documentElement.lang, {
            style: 'currency',
            currency: currency
        });

        $(submitButtonText).text(text + value)
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

        if (welcomeCard.isCourseSelected()) {
            welcomeCard.setPaymentAmount(welcomeCard.getPricePerUnit());

            // Course Selector element
            var courseSelector = document.getElementById('study');
            courseSelector.addEventListener('change', async (event) => {
                Forms.toggleInputs(event.target.value, {
                    'in-person': $('#staying').parents().eq(2),
                    'online': $('#hours').parents().eq(2)
                });

                let selectedCourse = await api.getResource('courses',{
                    course: event.target.value
                });

                welcomeCard.setPricePerUnit(selectedCourse.price.eur);
                welcomeCard.setPaymentAmount(selectedCourse.price.eur, paymentCurrency.value);
            });

            // Duration and Staying Inputs
            var staying = document.getElementById('staying');
            staying.addEventListener('change', async function(event) {
                let field = {
                    value: event.target.value,
                    name: event.target.getAttribute('name'),
                    validators: [
                        'required',
                        'integer',
                        'InPersonCoursesScope'
                    ]
                };

                let errors = await welcomeCard.handleServerErrorField(field, event.target);

                if (errors) {
                    event.target.value = welcomeCard.minimumStaying;
                    return false;
                }

                welcomeCard.setPaymentAmount(welcomeCard.getPricePerUnit(), paymentCurrency.value);
            });

            var hours = document.getElementById('hours');
            hours.addEventListener('change', async function(event) {
                let field = {
                    value: event.target.value,
                    name: event.target.getAttribute('name'),
                    validators: [
                        'required',
                        'integer',
                        'OnlineCoursesScope'
                    ]
                }

                let errors = await welcomeCard.handleServerErrorField(field, event.target);

                if (errors) {
                    event.target.value = welcomeCard.minimumHours;
                    return false;
                }

                welcomeCard.setPaymentAmount(welcomeCard.getPricePerUnit(), paymentCurrency.value);
            });

            // Set values to estimate the final price when the user changes
            // the course duration.
            welcomeCard.set('minimumHours', hours.value);
            welcomeCard.set('minimumStaying', staying.value);
        }

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
            welcomeCard.setPaymentAmount(welcomeCard.getPricePerUnit(), e.target.value);
        });

        Forms.preventDoubleClick(welcomeCard.forms.checkout.el());

        $(welcomeCard.forms.checkout.el()).on('submit', async (event) => {
            event.preventDefault();

            // Only for testing
            // console.log(api.getHostName() + '/payment-successful');
            // let newDialog = await api.continue(api.getHostName() + '/payment-successful');
            // welcomeCard.replaceDialog(newDialog);
            // return;

            // Sets the loader inside the checkout button.
            UI.changeLoadingButtonState(event.target);

            // Disables all inputs of the form.
            welcomeCard.disableCheckoutInputs(event.target, true);

            let paymentDetails = {
                card_holder_name: cardHolderName.value,
                email: document.querySelector('#email').value,
                phone_number: phoneNumber.value,
            };

            if (welcomeCard.isCourseSelected()) {
                paymentDetails[courseSelector.getAttribute('name')] = courseSelector.value;
                switch(courseSelector.value) {
                    case 'in-person':
                        paymentDetails['staying'] = document.getElementById('staying').value;
                        break;
                    case 'online':
                        paymentDetails['hours'] = document.getElementById('hours').value;
                        break;
                }
            }

            /*
             * If the validation succeeds returns an object with the billing
             * details.
             */
            const validation = await api.validateFields('payment-details', paymentDetails);

            /*
             * If errors have been encountered display the corresponding
             * messages.
             */
            if (validation.errors) {
                welcomeCard.handleErrorFields(Object.keys(validation.errors), validation.errors);

                // Hides the loader inside the checkout button.
                UI.changeLoadingButtonState(event.target);

                Forms.toggleDisablingForm(event.target);

                return false;
            }

            /*
             * Creates a paymentMethod to send its ID to the server so that
             * the user can be charged by the Stripe PHP API.
             */
            const { paymentMethod, error } = await stripe.createPaymentMethod(
                'card', cardNumber, {
                    billing_details: validation
                }
            );

            // Check the form for errors.
            if (error) {
                welcomeCard.displayInputFieldError('submit', error.message);

                /*
                 * Resets the event that prevents the double click when pressing
                 * the submit button.
                 */
                Forms.toggleDisablingForm(event.target);

                // Hides the loader inside the checkout button.
                UI.changeLoadingButtonState(event.target);
            } else {
                /**
                 * If no errors found it, gathers the information needed to Stripe PHP API
                 * so the payment can be applied in the server.
                 */
                let data = {
                    _token: welcomeCard.forms.checkout.el().querySelector('input[type="hidden"').value,
                    currency: document.getElementById('payment-currency').value,
                    card_holder_name: paymentMethod.billing_details.name,
                    email: paymentMethod.billing_details.email,
                    phone_number: paymentMethod.billing_details.phone,
                    payment_method: paymentMethod.id,
                };

                if (welcomeCard.isCourseSelected()) {
                    data.study = courseSelector.value;

                    switch(data.study) {
                        case 'in-person':
                            data.staying = document.getElementById('staying').value;
                            break;
                        case 'online':
                            data.hours = document.getElementById('hours').value;
                            break;
                    }
                }

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

                            /*
                             * Resets the event that prevents the double click when pressing
                             * the submit button.
                             */
                            Forms.toggleDisablingForm(event.target);

                            // Hides the loader inside the checkout button.
                            UI.changeLoadingButtonState(event.target);

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
                            welcomeCard.disableCheckoutInputs(welcomeCard.forms.checkout.el(), false);

                            // Hides the loader inside the checkout button.
                            UI.changeLoadingButtonState(event.target);

                            Forms.toggleDisablingForm(event.target);
                        }
                    })

                // Only when JavaScript is disabled
                // document.querySelector('#payment-method').value = paymentMethod.id;
                // welcomeCard.forms.checkout.el().submit();
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
    getCourseDuration: function() {
        var courseSelector = document.querySelector('#study');

        if (welcomeCard.isCourseSelected()) {
            switch(courseSelector.value) {
                case 'in-person':
                    return document.getElementById('staying').value;
                case 'online':
                    return document.getElementById('hours').value;
            }
        }

        return 1;
    },
    setPaymentAmount: async function(value, currency = 'eur') {
        value = await welcomeCard.currencyExchange(value, currency);
        value *= welcomeCard.getCourseDuration();
        welcomeCard.updatePaymentButton(value, currency);
    },
    // setPaymentAmount: function(value, currency = 'eur') {
    //     if (welcomeCard.paymentAmount !== null) {
    //         // Check if the given currency is a zero-decimal currency
    //         let multiplier = currencies[currency].decimal_digits > 0
    //             ? Math.pow(10, currencies[currency].decimal_digits) : 1;
    //
    //         // Remove decimals to set the amount in the less unit of measure (cents)
    //         welcomeCard.paymentAmount = (value * multiplier).toFixed(0);
    //         return true;
    //     }
    //
    //     welcomeCard.paymentAmount = value;
    // },
    disableCheckoutInputs: (form, disabled) => {
        Forms.disableFormInputs(form, disabled);
        Forms.disableStripeInputs(form, disabled);
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
        var displayError = document.getElementById(field + '-errors') !== null ? document.getElementById(field + '-errors') : document.getElementById('submit-errors');
        console.log(displayError);
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

