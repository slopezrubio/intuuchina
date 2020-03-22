import { FormFactory } from "../../factories/FormsFactory";

import { paymentFormFactory } from './PaymentForm';
import { dialogFactory } from '../Dialog';

import api from '../../facades/api';

function ProceedPaymentForm(options) {
    this.dialog = null;
    this.paymentForm = null,

    this.init = function() {
        if (this.el !== null) {
            this.dialog = dialogFactory.createDialog();
            this.fields = {
                token: this.el.querySelector('[name=_token]'),
            };

            this.el.addEventListener('submit', async (event) => {
                event.preventDefault();

                if (this.dialog !== null) {
                    this.toggleLoadingState();
                    let dialog = await this.submit();
                    this.dialog = this.dialog.replace(dialog);
                    this.paymentForm = paymentFormFactory.createForm({
                        form: document.getElementById('payment'),
                        type: 'payment',
                    });

                    this.paymentForm.init();
                }

                event.target.submit();
            })
        }
    };

    this.submit = async function() {
        return await api.axiosRequest(this.getActionUrl(), 'post', {
            _token: this.getToken()
        });
    };

    this.getToken = function() {
        return this.fields.token.value;
    };
}

export var proceedPaymentFormFactory = new FormFactory();

export default ProceedPaymentForm;