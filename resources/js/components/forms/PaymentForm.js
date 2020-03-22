import { FormFactory } from "../../factories/FormsFactory";
import {Dialog, dialogFactory} from "../Dialog";

import str from '../../facades/str';
import money from '../../facades/money';
import api from '../../facades/api';

function PaymentForm(options) {
    this.stripeElements = ['card'];
    this.stripeElementsStyles = {
        generic: {
            base: {

            }
        }
    };

    /**
     * Form fields
     *
     * @type {{duration: {hours: HTMLElement, staying: HTMLElement}, card_holder: HTMLElement, study: HTMLElement, stripe: {}, phone_number: HTMLElement, currency: HTMLElement, payment: Element, email: HTMLElement, card: {number: HTMLElement, cvc: HTMLElement, expiry: HTMLElement}}}
     */
    this.fields = {
        card_holder: document.getElementById('card_holder'),
        phone_number: document.getElementById('phone_number'),
        email: document.getElementById('payment-email'),
        study: document.getElementById('study'),
        duration: {
            hours: document.getElementById('hours'),
            staying: document.getElementById('staying'),
        },
        card: {
            number: document.getElementById('card-number'),
            cvc: document.getElementById('card-cvc'),
            expiry: document.getElementById('card-expiry')
        },
        currency: document.getElementById('payment-currency'),
        payment: document.getElementById('checkout-button-sku_GDHDkOPWtjGF2w'),
        token: document.getElementsByName('_token')[0],
        stripe: {},
    };

    // Dialog component
    this.dialog = null;

    this.paymentIntent = null;

    // Selected course
    this.selectedCourse = null;

    // Payment details
    this.paymentDetails = null;

    this.stripe = null;

    // Used patterns
    this.patterns = {
        getActionText: new RegExp(/^([A-Z]?[\s\D][^A-Z\u00A5-\u20BF\u0024\u00A3\d.]+)/),
    };

    this.dialog = null;

    this.pricePerUnit = this.fields.payment.querySelector('span').getAttribute('data-value') / 100;

    this.getCourseDuration = function(obj = false) {
        if (this.fields.study !== null) {
            switch(this.fields.study.value) {
                case 'in-person':
                    if (obj) {
                        obj['staying'] = this.fields.duration.staying.value;
                        return obj;
                    }
                    return this.fields.duration.staying.value;
                case 'online':
                    if (obj) {
                        obj['hours'] = this.fields.duration.hours.value;
                        return obj;
                    }
                    return this.fields.duration.hours.value;
                default:
                    return this.fields.duration.staying.value;
            }
        }

        return 1;
    },

    this.init = async function() {
        if (this.el !== null) {
            this.dialog = dialogFactory.createDialog();

            this.loadStripeElements();

            this.setPaymentAmount();

            this.selectedCourse = await api.axiosRequest(api.getResource('courses', this.fields.study.value));

            this.fields.study.addEventListener('change', async (event) => {
                this.toggleInputs([
                    this.fields.duration.staying,
                    this.fields.duration.hours,
                ]);

                this.selectedCourse = await api.axiosRequest(api.getResource('courses', event.target.value));

                this.setTotalCoursePrice('eur')
                    .setPaymentAmount();
            });

            this.fields.duration.staying.addEventListener('change', async (event) => {
                this.validateField(event.target, [
                    'required',
                    'integer',
                    'InPersonCoursesScope'
                ]);

                this.setMinimumDuration()
                    .setPaymentAmount();
            });

            this.fields.duration.hours.addEventListener('change', async (event) => {
                this.validateField(event.target, [
                    'required',
                    'integer',
                    'OnlineCoursesScope'
                ]);

                this.setMinimumDuration()
                    .setPaymentAmount();
            });

            this.fields.card_holder.addEventListener('change', (event) => {
                this.validateField(event.target, [
                    'ValidName'
                ])
            });

            this.fields.phone_number.addEventListener('change', (event) => {
                this.validateField(event.target, [
                    'required',
                    'numeric',
                    'PhoneNumber'
                ])
            });

            this.fields.email.addEventListener('change', (event) => {
                this.validateField(event.target, [
                    'required',
                    'email',
                ])
            });

            this.fields.currency.addEventListener('change', async (event) => {
                this.setPaymentAmount(event.target.value);
            });

            $(this.el).on('submit', async (event) => {
                event.preventDefault();

                this.toggleLoadingState();
                this.disableStripeInputs();

                this.paymentDetails = this.createPaymentDetails([
                    'card_holder',
                    'email',
                    'phone_number',
                    'duration',
                ]);

                /*
                 * If the validation succeeds returns an object with the billing
                 * details.
                 */
                const validation = await this.validatePaymentDetails();

                /*
                 * If errors have been encountered display the corresponding
                 * messages.
                 */
                if (validation.errors) {
                    Object.keys(validation.errors).forEach((fieldName) => {
                        this.displayFieldError(this.fields[fieldName], validation.errors[fieldName][0]);
                    });

                    this.toggleLoadingState();
                    this.disableStripeInputs(false);

                    return false;
                }

                /*
                 * Creates a paymentMethod to send its ID to the server so that
                 * the user can be charged by the Stripe PHP API.
                 */
                const { paymentMethod, error } = await stripe.createPaymentMethod('card', this.fields.stripe['card-number'], {
                    billing_details: validation
                });

                if (error) {
                    this.toggleLoadingState();
                    this.disableStripeInputs(false);

                    return false;
                }

                this.sendPaymentInformation({
                    token: this.fields.token.value,
                    card_holder: this.fields.card_holder.value,
                    email: paymentMethod.billing_details.email,
                    phone_number: paymentMethod.billing_details.phone,
                    currency: this.fields.currency.value,
                    dialog: this.dialog !== null,
                    payment_method: paymentMethod.id
                });
            })
        }
    };

    this.sendPaymentInformation = async function(data) {
        let paymentInformation = {
            _token: data.token ? data.token : null,
            card_holder: data.card_holder ? data.card_holder : null,
            email: data.email ? data.email : null,
            phone_number: data.phone_number ? data.phone_number : null,
            currency: data.currency ? data.currency : null,
            payment_method: data.payment_method ? data.payment_method : null,
            payment_intent_id: data.payment_intent_id,
            dialog: data.dialog ? data.dialog : null,
        };

        paymentInformation = this.getCourseDuration(paymentInformation);

        const result = await api.axiosRequest(api.getRoute('payment_method'), 'post', paymentInformation);

        if (result.error) {
            this.displayStripeErrors('submit', result.error.message);

            this.toggleLoadingState();
            this.disableStripeInputs(false);

            return this;
        }

        this.handlePaymentResponse(result);
    };

    /**
     * Receives the response of the «stripe.handleCardAction» method. If the Payment Intent
     * has sent an error it will show the error message just above the submit button. Otherwise
     * it will sent the Payment Method Intent ID to the server to finally complete and
     * confirm the payment linked to the Payment Method sent previously.
     *
     * @param result
     */
    this.handleStripeJsResult = (result) => {

        if (result.error) {
            this.displayStripeErrors('submit', result.error.message);
            return result;
        }

        this.paymentIntent = result.paymentIntent;

        this.sendPaymentInformation({
            token: this.fields.token.value,
            payment_intent_id: result.paymentIntent.id,
        })
    };

    this.handlePaymentResponse = async function(response) {

        /*
         * Gets the server response and checks whether the payment has failed.
         */
        if (response.error) {
            this.displayStripeErrors('submit', response.error.message);
            return this;
        }

        /**
         * Checks if the Payment Intent requires another step of authentication (3D Authentication)
         * and try to confirm the payment once again.
         */
        if (response.requires_action) {

            /*
             * Triggers the next authentication step or action where the user is likely
             * to be required for a 3D Secure (mandatory by the Strong Customer Authentication)
             * regulation in Europe.
             */
            stripe.confirmCardPayment(response.payment_intent_client_secret)
                .then(this.handleStripeJsResult);

            // stripe.handleCardAction(response.payment_intent_client_secret)
            //    .then((result) => {
            //        console.log(result);
            //    });

            return this;
        }

        /*
         * The payment has been successfully created and shows a confirmation dialog to the user
         * in case the form is located inside of it.
         */
        if (this.dialog !== null) {
            this.dialog.replace(response);
            return this;
        }

        this.paymentIntent = response;

        this.sendPaymentInformation({
            token: this.fields.token.value,
            payment_intent_id: this.paymentIntent.id,
        });

        console.log(response);

        window.location.href = api.setLaravelParams(api.getRoute('paid'), [
            this.getCharge(),
        ]);
    };

    this.getCharge = function() {
        return this.paymentIntent.charges.data[0].id;
    };

    this.createPaymentDetails = function(fields) {
        let obj = {};

        obj.name = 'payment-details';

        fields.forEach((field) => {
            switch (field) {
                case 'duration':
                    obj = this.getCourseDuration(obj);
                    break;
                default:
                    obj[field] = this.fields[field].value;
                    break;
            }
        });

        return obj;
    };

    this.validatePaymentDetails = async function() {
        return await api.validate(this.paymentDetails);
    };

    this.setMinimumDuration = function() {
        if (this.fields.study !== null) {
            switch(this.fields.study.value) {
                case 'in-person':
                    this.fields.duration.staying.value = this.fields.duration.staying.value < this.selectedCourse.scope.min
                        ? this.selectedCourse.scope.min
                        : this.fields.duration.staying.value;
                    break;
                case 'online':
                    this.fields.duration.hours.value = this.fields.duration.hours.value < this.selectedCourse.scope.min
                        ? this.selectedCourse.scope.min
                        : this.fields.duration.hours.value;
                    break;
            }
        }

        return this;
    };

    this.isStripeLoaded = function() {
        return this.fields.stripe.card.number.childElementCount > 0;
    };

    this.disableStripeInputs = function(disabled = true) {
        Object.keys(this.fields.stripe).forEach((key) => {
            this.fields.stripe[key].update({
                disabled: disabled,
            })
        });

        return this;
    };

    this.displayStripeErrors = function(fieldName, message) {
        if (fieldName !== 'submit') {
            let formGroup = $('#' + fieldName).parents('.form-group')[0];

            $(formGroup).find('.StripeElement').each(function(index, element) {
                $(element).addClass('is-invalid');
            });

            $(formGroup).find('.invalid-feedback').each((index, element) => {
                $(element).css('display', 'block');
            });

            $(formGroup).find('#' + fieldName + '-errors').text(message);
            return this;
        }

        $('#' + fieldName + '-errors').text(message);
    };

    this.removeStripeErrors = function(fieldName) {
        let formGroup = $('#' + fieldName).parents('.form-group')[0];

        $(formGroup).find('.StripeElement').each(function(index, element) {
            $(element).removeClass('is-invalid');
        });

        $(formGroup).find('#' + fieldName + '-errors').empty();
    };

    this.mountStripeFields = function() {

        this.stripeElements.forEach((element) => {
            let elementName = element;

            if (this.fields[element] !== null && this.fields[element][Symbol.iterator] !== 'function') {
                Object.keys(this.fields[element]).map(((key) => {
                    let fieldName = str.kebabCase(element + ' ' + key);
                    this.fields.stripe[fieldName] = this.stripe.create(str.camelCase(element + ' ' + key), {
                        style: this.stripeElementsStyles.generic
                    });
                    this.fields.stripe[fieldName].mount('#' + this.fields[element][key].getAttribute('id'));
                    this.fields.stripe[fieldName].addEventListener('change', ({error}) => {
                        if (error !== undefined) {
                            this.displayStripeErrors(fieldName, error.message);
                        } else {
                            this.removeStripeErrors(fieldName);
                        }
                    })
                }));

                return;
            };

            this.fields.stripe.create(element, {
                style: this.stripeElementsStyles.generic
            });
        });
    };

    this.setTotalCoursePrice = function(currency = 'eur') {
        this.pricePerUnit = this.selectedCourse.price[currency];

        return this;
    };

    this.loadStripeElements = function() {
        this.stripe = stripe.elements({
            fonts: [{
                cssSrc: "https://fonts.googleapis.com/css?family=Montserrat"
            }],
        });

        this.mountStripeFields();

        return this;
    };

    this.setPaymentAmount = async function(currency = 'eur') {
        let total = await money.exchangeCurrency(this.pricePerUnit, currency);

        total *= this.getCourseDuration();

        let tmp = $(this.fields.payment).children('span')[0]
                    .textContent.match(this.patterns.getActionText)[0];

        total = parseFloat(total).toLocaleString(document.documentElement.lang, {
            style: 'currency',
            currency: currency
        });

        $(this.fields.payment).children('span')[0].textContent = tmp + total;

        return this;
    }
}

export var paymentFormFactory = new FormFactory();

export default PaymentForm;