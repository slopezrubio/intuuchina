import { FormFactory } from "../../factories/FormsFactory";
import { Dialog, dialogFactory } from "../Dialog";

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
     * @type {{duration: {lessons: HTMLElement, months: HTMLElement}, card_holder: HTMLElement, courses: HTMLElement, stripe: {}, phone_number: HTMLElement, currency: HTMLElement, payment: Element, email: HTMLElement, card: {number: HTMLElement, cvc: HTMLElement, expiry: HTMLElement}}}
     */
    this.fields = {
        card_holder: document.getElementById('card_holder'),
        prefix: document.getElementById('prefix'),
        phone_number: document.getElementById('phone_number'),
        email: document.getElementById('payment-email'),
        course: document.getElementById('course'),
        total: document.getElementById('total'),
        subtotal: document.getElementById('subtotal'),
        card: {
            number: document.getElementById('card-number'),
            cvc: document.getElementById('card-cvc'),
            expiry: document.getElementById('card-expiry')
        },
        payment: document.getElementById('checkout-button-sku_GDHDkOPWtjGF2w'),
        token: document.getElementsByName('_token')[0],
        stripe: {},
    };

    // Dialog component
    this.dialog = null;

    this.paymentIntent = null;

    // Selected course
    this.course = null;

    // Payment details
    this.paymentDetails = null;

    this.stripe = null;

    // Used patterns
    this.patterns = {
        getActionText: new RegExp(/^([A-Z]?[\s\D][^A-Z\u00A5-\u20BF\u0024\u00A3\d.]+)/),
    };

    this.dialog = null;

    this.price = {};

    this.pricePerUnit = null;

    this.getCourseDuration = function(obj = null) {
        if (this.fields.course !== null) {

            if (obj !== null) {
                obj[pluralize.plural(this.course.data.fee.unit)] = this.fields[pluralize.plural(this.course.data.fee.unit)].value;

                return obj;
            }

            return this.fields[pluralize.plural(this.course.data.fee.unit)].value;
        }

        return 1;
    },

    this.setUnitFields = function() {
        this.fields[pluralize.plural(this.course.data.fee.unit)] = this.el.querySelector('#' + pluralize.plural(this.course.data.fee.unit));

        this.fields[pluralize.plural(this.course.data.fee.unit)].addEventListener('change', async (event) => {
            this.toggleLoadingState();
            this.disableStripeInputs();

            this.setSubtotal()
                .setTotal();

            this.toggleLoadingState();
            this.disableStripeInputs(false);
        });
    },

    this.init = async function() {
        if (this.el !== null) {
            this.dialog = dialogFactory.createDialog();

            this.loadStripeElements();

            this.pricePerUnit = this.fields.payment.querySelector('span').getAttribute('data-value') / 100;

            if (this.fields.course !== null) {
                this.course = await api.axiosRequest(api.getResource('courses', this.fields.course.value));
                this.setUnitFields();

                this.setSubtotal()
                    .setTotal();

                this.fields.course.addEventListener('change', async (event) => {
                    this.toggleLoadingState();
                    this.disableStripeInputs();

                    let oldInput = this.fields[pluralize.plural(this.course.data.fee.unit)];

                    this.course = await api.axiosRequest(api.getResource('courses', event.target.value));

                    this.setUnitFields();

                    this.toggleInputs([
                        oldInput,
                        this.fields[pluralize.plural(this.course.data.fee.unit)],
                    ]);

                    this.setSubtotal()
                        .setTotal();

                    this.toggleLoadingState();
                    this.disableStripeInputs(false);
                });
            }

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

            $(this.el).on('submit', async (event) => {
                event.preventDefault();

                this.toggleLoadingState();
                this.disableStripeInputs();

                this.paymentDetails = this.createPaymentDetails();

                /*
                 * If the validation succeeds returns an object with the billing
                 * details.
                 */
                const validation = await this.validatePaymentDetails();

                console.log(validation);

                /*
                 * If errors have been encountered display the corresponding
                 * messages.
                 */
                if (validation.errors) {
                    Object.keys(this.paymentDetails).forEach((fieldName) => {
                        if (validation.errors[fieldName] !== undefined) {
                            this.displayFieldError(this.fields[fieldName], validation.errors[fieldName][0]);
                        } else {
                            this.removeFieldError(this.fields[fieldName]);
                        }
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

                let paymentInformation = {
                    _token: this.fields.token !== null ? this.fields.token.value : null,
                    card_holder: this.fields.card_holder !== null ? this.fields.card_holder.value : null,
                    email: paymentMethod.billing_details.email,
                    prefix: this.fields.prefix.value,
                    phone_number: paymentMethod.billing_details.phone,
                    dialog: this.dialog !== null,
                    quantity: this.course !== null ? this.fields[pluralize.plural(this.course.data.fee.unit)].value : null,
                    course: this.fields.course !== null ? this.fields.course.value : null,
                    payment_method: paymentMethod.id
                };

                this.getCourseDuration(paymentInformation);

                this.sendPaymentInformation(paymentInformation);
            })
        }
    };

    this.sendPaymentInformation = async function(paymentInformation) {

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

        console.log(response);

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

        window.location.href = api.setLaravelParams(api.getRoute('paid'), [
            this.getCharge(),
        ]);
    };

    this.getCharge = function() {
        return this.paymentIntent.charges.data[0].id;
    };

    this.createPaymentDetails = function() {
        let obj = {
            name: 'payment-details',
            card_holder: this.fields.card_holder.value,
            phone_number: this.fields.phone_number.value,
            email: this.fields.email.value,
        };

        if (this.course !== null) {
            obj['course'] = this.course.data.value;
            obj[pluralize.plural(this.course.data.fee.unit)] = this.fields[pluralize.plural(this.course.data.fee.unit)].value;
        };

        return obj;
    };

    this.validatePaymentDetails = async function() {
        return await api.validate(this.paymentDetails);
    };

    this.setMinimumDuration = function(unit) {
        if (this.fields.course !== null) {
            if (this.course.data.fee.minimum > this.fields[unit].value) {
                this.fields[unit].value = this.course.data.fee.minimum;
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

    this.setSubtotal = function() {
        console.log(this.course);
        if (this.course !== null) {
            this.price.subtotal = this.course.data.fee.amount * this.fields[pluralize.plural(this.course.data.fee.unit)].value;
            return this;
        }

        this.price.subtotal = this.pricePerUnit;
        return this;
    };

    this.setTotal = function(currency = 'eur') {
        let percentage = this.course.data.fee.applicable_vat.percentage / 100;

        this.price.total = this.price.subtotal + (this.price.subtotal * percentage);

        this.displayTotalPrice();

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

    this.displayTotalPrice = async function(currency = 'eur') {
        let verb = $(this.fields.payment).children('span')[0]
            .textContent.match(this.patterns.getActionText)[0];

        let total = parseFloat(await money.exchangeCurrency(this.price.total, currency)).toLocaleString(document.documentElement.lang, {
            style: 'currency',
            currency: currency
        });

        let subtotal = parseFloat(await money.exchangeCurrency(this.price.subtotal, currency)).toLocaleString(document.documentElement.lang, {
            style: 'currency',
            currency: currency
        });;

        this.fields.subtotal.textContent = subtotal;

        $(this.fields.payment).children('span')[0].textContent = verb + total;

        let regexp = /[€|$]((\d{1,3},)*\d{1,3}\.\d*)/g;

        $(this.fields.total).children('span')[0].textContent = $(this.fields.total).children('span')[0].textContent.replace(regexp, parseFloat(await money.exchangeCurrency(this.price.total - this.price.subtotal, currency)).toLocaleString(document.documentElement.lang, {
            style: 'currency',
            currency: currency
        }));

        $(this.fields.total).children('span')[2].textContent = $(this.fields.total).children('span')[2].textContent.replace(regexp, subtotal);

        $(this.fields.total).children('span.total')[0].textContent = total;


        return this;
    }
}

export var paymentFormFactory = new FormFactory();

export default PaymentForm;