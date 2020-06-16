import { createOfferFormFactory } from "../../components/forms/CreateOfferForm";

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('new-offer') !== null) {
            console.log("hola");
            var createOfferForm = createOfferFormFactory.createForm({
                form: document.getElementById('create-offer'),
                type: 'create-offer',
            }).init();
        }
    })
})();