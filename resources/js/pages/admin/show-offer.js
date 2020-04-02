import { editOfferFormFactory } from "../../components/forms/EditOfferForm";

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        var editOfferForm = editOfferFormFactory.createForm({
            form: document.getElementById('edit-offer'),
            type: 'edit-offer',
        }).init();
    })
})();