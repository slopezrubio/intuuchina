import { proceedPaymentFormFactory } from '../components/forms/ProceedPaymentForm';
import { paymentFormFactory } from '../components/forms/PaymentForm';

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        var proceedPaymentForm = proceedPaymentFormFactory.createForm({
            form: document.getElementById('proceed-payment'),
            type: 'proceed-payment',
        });

        proceedPaymentForm.init();
    });
})();