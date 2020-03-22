import { paymentFormFactory } from '../../components/forms/PaymentForm';

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        var paymentForm = paymentFormFactory.createForm({
            form: document.getElementById('payment'),
            type: 'payment',
        });

        paymentForm.init();
    });
})();