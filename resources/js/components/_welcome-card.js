const axios = require('axios');

import domObserver from "../main/domObserver.js";
import dom from '../main/dom';
import api from '../main/api';

let welcomeCard = {
    init: function() {
        window.addEventListener('DOMContentLoaded', function() {
            domObserver(welcomeCard.dialogBoxContainer.parentElement, welcomeCard.update);
        });
        welcomeCard.setup();
    },
    dialogBoxContainer: document.querySelector('#dialog-box') ? document.querySelector('#dialog-box') : null,
    update: function() {
        welcomeCard.setup();
    },
    forms: {
        confirm: {
            el: function() { return document.querySelector('#confirm') ? document.querySelector('#confirm') : null }
        },
        checkout: {
            el: function() { return document.querySelector('#checkout') ? document.querySelector('#checkout') : null }
        }
    },
    setup: function() {
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

        if (welcomeCard.forms.checkout.el() !== null) {
            if (!welcomeCard.isStripeLoaded()) {
                welcomeCard.setStripeElements();
            }
        }
    },
    isStripeLoaded: function() {
        return welcomeCard.forms.checkout.el().querySelector('#card-number').childElementCount > 0;
    },
    replaceDialog: function(newDialogBox) {
        let container = welcomeCard.dialogBoxContainer.parentElement;
        $(welcomeCard.dialogBoxContainer).empty();
        $(container).html(newDialogBox);
    },
    handleErrorField: async function(field, element) {
        let errors = await api.validate(field);

        const displayError =  document.getElementById(field.name + '-errors');

        if (errors !== null) {
            displayError.style.display = 'block';
            displayError.textContent = errors['value'][0];
            element.classList.add('is-invalid')
        } else {
            displayError.style.display = 'none';
            element.classList.remove('is-invalid');
        }
    },
    setStripeElements: function() {
        var elements = stripe.elements({
            fonts: [{
                cssSrc: "https://fonts.googleapis.com/css?family=Montserrat"
            }],
        });

        // Holdername Element
        var cardHolderName = document.getElementById('card-holder-name');

        // Email payer Element
        var cardEmailPayer = document.getElementById('email-payer');

        // Stripe Card Number Element
        var cardNumber = welcomeCard.setStripeCardNumber(elements);
        cardNumber.mount('#card-number');

        // Stripe Card Expiry element
        var cardExpiry = welcomeCard.setCardExpiry(elements);
        cardExpiry.mount('#card-expiry');

        // Stripe Card CVC element
        var cvc = welcomeCard.setCVCInputField(elements);
        cvc.mount('#card-cvc');

        // Payment Request Options
        var paymentRequest = stripe.paymentRequest({
            country: 'ES',
            currency: 'eur',
            total: {
                amount: 20,
                label: 'Application Fee Payment',
            },
            requestPayerPhone: true,
            requestPayerEmail: true,
        });

        /**
         * STRIPE ELEMENTS EVENTS
         */
        cardHolderName.addEventListener('change', (event) => {
            let field = {
                value: event.target.value,
                name: event.target.getAttribute('name'),
                validators: 'required|alpha'
            };

            welcomeCard.handleErrorField(field, event.target)
        });

        cardEmailPayer.addEventListener('change', (event) => {
            let field = {
                value: event.target.value,
                name: event.target.getAttribute('name'),
                validators: 'required|email'
            };

            welcomeCard.handleErrorField(field, event.target);
        });

        cardNumber.addEventListener('change', ({error}) => {
            const displayError = document.getElementById('card-number-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = ''
            }
        });

        cvc.addEventListener('change', ({error}) => {
            const displayError = document.getElementById('cvc-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = '';
            }
        });

        cardExpiry.addEventListener('change', ({error}) => {
            const displayError = document.getElementById('card-expiry-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = '';
            }
        });

        $('#payment-request-button, #checkout-button').on('click', async (e) => {
            const { paymentMethod, error } = await stripe.createPaymentMethod(
                'card', cardNumber, {
                    billing_details: {
                        name: cardHolderName.value,
                        email: document.querySelector('#email-payer').value,
                    }
                }
            );

            if (error) {
                /*var displayError = document.getElementById('submit-errors');
                displayError.textContent = error.message;*/

                console.log(error);
            }
        });

        var paymentRequestButton = welcomeCard.setStripePaymentRequestButton(elements, paymentRequest);

        welcomeCard.setCheckoutForm(cardNumber);
    },
    setCheckoutForm: function(element) {
        welcomeCard.forms.checkout.el().addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(element, {
                name: document.getElementById('card-holder-name').value,
                email: document.getElementById('email-payer').value
            }).then(function(result) {

            })
        })
    },
    setStripeCardNumber: function(elements) {
        return elements.create('cardNumber');
    },
    setCVCInputField: function(elements) {
        return elements.create('cardCvc', {
            placeholder: '123'
        })
    },
    setCardExpiry: function(elements) {
        return elements.create('cardExpiry', {
            placeholder: 'MM / YY'
        })
    },
    setStripePaymentRequestButton: function(elements, paymentRequest) {
        var paymentRequestButton = elements.create('paymentRequestButton', {
            paymentRequest: paymentRequest
        });

        paymentRequest.canMakePayment().then(function(result) {
            if (result) {
                paymentRequestButton.mount('#payment-request-button');
            } else {
                document.getElementById('payment-request-button').style.display = 'none';
                document.getElementById('checkout-button').parentElement.style.display = 'block';
            }
        });

        paymentRequest.on('paymentmethod', function(e) {
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
                        /*if () {

                        }*/
                    })
                }
            })
        });
    }
}

if (document.querySelector('.user-card')) {
    welcomeCard.init();
}

