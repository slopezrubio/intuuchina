import { createOfferFormFactory } from "../../components/forms/CreateOfferForm";

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('new-offer') !== null) {
            var createOfferForm = createOfferFormFactory.createForm({
                form: document.getElementById('create-offer'),
                type: 'create-offer',
            }).init();
        }
    })
})();