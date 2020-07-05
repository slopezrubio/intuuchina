import { createFeeFormFactory } from "../../components/forms/CreateFeeForm";

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('new-fee') !== null) {
            var createOfferForm = createFeeFormFactory.createForm({
                form: document.getElementById('create-fee'),
                type: 'create-fee',
            }).init();
        }
    })
})();