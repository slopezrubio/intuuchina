import { accordionListFactory } from "../../components/AccordionList";
import { mediaCardFactory } from "../../components/MediaCards";
import { deleteOfferFormFactory } from "../../components/forms/DeleteOfferForm";
import { deleteUserFormFactory } from "../../components/forms/DeleteUserForm";

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        var offersCards = mediaCardFactory.createCard({
            el: document.getElementById('offers'),
            type: 'media',
            form: deleteOfferFormFactory.createForm({
                form: document.getElementById('delete-offer'),
                type: 'delete-offer',
            }).init(),
        }).init();

        var usersList = accordionListFactory.createList({
            el: document.getElementById('users'),
            type: 'accordion',
            form: deleteUserFormFactory.createForm({
                form: document.getElementById('delete-user'),
                type: 'delete-user',
            }).init(),
        }).init();

        $(usersList.form.modal.getAllTriggerElements()).each((key, element) => {
            element.addEventListener('click', (ev) => {
                usersList.form.modal.setModalTitle(usersList.getCardTitle(key));
                usersList.form.setItemAction(ev.target.getAttribute('data-value'));
            })
        });

        $(offersCards.form.modal.getAllTriggerElements().each((key, element) => {
            element.addEventListener('click', (ev) => {
                offersCards.form.modal.setModalTitle(offersCards.getCardTitle(key));
                offersCards.form.setItemAction(ev.target.getAttribute('data-value'));
            })
        }));
    })
})();