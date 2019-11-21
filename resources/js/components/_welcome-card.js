const axios = require('axios');

import domObserver from "../main/domObserver.js";
import api from '../main/api';

let welcomeCard = {
    init: function() {
        window.addEventListener('DOMContentLoaded', function() {
            domObserver(welcomeCard.dialogContainer.parentElement, welcomeCard.update);
        });
        welcomeCard.setup();
    },
    dialogContainer: document.querySelector('#dialog') ? document.querySelector('#dialog') : null,
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
    replaceDialog: function(newDialog) {
        let container = welcomeCard.dialogContainer.parentElement;
        $(welcomeCard.dialogContainer).empty();
        $(container).html(newDialog);
    },
    setStripeElements: function() {
        var elements = stripe.elements({
            fonts: [{
                cssSrc: "https://fonts.googleapis.com/css?family=Montserrat"
            }],
        });

        // Stripe Card Number Element
        var cardNumber = welcomeCard.setStripeCardNumber(elements);
        cardNumber.mount('#card-number');
        cardNumber.addEventListener('change', ({error}) => {
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = ''
            }
        });

        // Stripe Card Expiry element
        var cardExpiry = welcomeCard.setCardExpiry(elements);
        cardExpiry.mount('#card-expiry');

        // Stripe Card CVC element
        var cvc = welcomeCard.setCVCInputField(elements);
        cvc.mount('#card-cvc');

        // Holdername field
        var cardHolderName = document.getElementById('card-holder-name');


        // Stripe Checkout PaymentRequestButton Element
        $('#payment-request-button, #checkout-button').on('click', async (e) => {
            const { paymentMethod, error } = await stripe.createPaymentMethod(
                'card', cardNumber, {
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            );

            /*if (error) {
                var displayError = document.getElementById('submit-errors');
                displayError.textContent = error.message;
            }*/
        });
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
        var paymentRequestButton = welcomeCard.setStripePaymentRequestButton(elements, paymentRequest);

        welcomeCard.setCheckoutForm(cardNumber);
    },
    setCheckoutForm: function(element) {
        welcomeCard.forms.checkout.el().addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(element, {
                name: document.getElementById('card-holder-name'),
                email: document.getElementById('email-payer')
            }).then(function(result) {

            })
        })
    },
    setStripeCardNumber: function(elements) {
        return elements.create('cardNumber', {
            value: {
                cardHolder: 'Steve Stifler'
            }
        });
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
    /*replace: function(oldElement, newElement) {
        let container = oldElement.parentElement;
        $(oldElement).empty();

        if (typeof newElement === 'string') {
            $(container).html(newElement);
        }
    },*/
}

if (document.querySelector('.user-card')) {
    welcomeCard.init();
}

