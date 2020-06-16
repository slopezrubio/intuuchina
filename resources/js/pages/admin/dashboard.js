import { accordionListFactory } from "../../components/AccordionList";
import { mediaCardFactory } from "../../components/MediaCards";
import { deleteOfferFormFactory } from "../../components/forms/DeleteOfferForm";
import { deleteUserFormFactory } from "../../components/forms/DeleteUserForm";
import { deleteFeeFormFactory } from "../../components/forms/DeleteFeeForm";
import { flexTableFactory } from "../../components/FlexTable";
import { userStatusFilterFactory } from "../../components/filters/UserStatusFilter";

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        if (document.querySelector('main#dashboard') !== null) {
            if (document.querySelector('#offers-content-tab') !== null) {
                var offersCards = mediaCardFactory.createCard({
                    el: document.getElementById('offers'),
                    type: 'media',
                    form: deleteOfferFormFactory.createForm({
                        form: document.getElementById('delete-offer'),
                        type: 'delete-offer',
                    }).init(),
                }).init();

                $(offersCards.form.modal.getAllTriggerElements().each((key, element) => {
                    element.addEventListener('click', (ev) => {
                        offersCards.form.modal.setModalTitle(offersCards.getCardTitle(offersCards.getParentItem(element)).innerText);
                        offersCards.form.setItemAction(ev.target);
                    })
                }));
            }

            if (document.querySelector('#users-content-tab') !== null) {
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
                        usersList.form.modal.setModalTitle(usersList.getCardTitle(usersList.getParentCard(element)).innerText);
                        usersList.form.setItemAction(ev.target);
                    })
                });

                if (document.getElementById('statusFilter') !== null) {
                    var UsersStatusFilter = new userStatusFilterFactory.createFilter({
                        type: 'user-status',
                        filter: document.getElementById('statusFilter'),
                        callback: function(data) {
                            $(document.querySelector('#users-content-tab')).find('.accordion-list').remove();
                            $(document.querySelector('#users-content-tab')).find('.items-pagination').remove();
                            $(document.querySelector('#users-content-tab')).find('.content-tab').append(data);
                        }
                    });
                }
            }

            if (document.querySelector('#fees-content-tab') !== null) {
                var feesTable = flexTableFactory.createTable({
                    el: document.getElementById('fees'),
                    type: 'flex',
                    form: deleteFeeFormFactory.createForm({
                        form: document.getElementById('delete-fee'),
                        type: 'delete-fee',
                    }).init(),
                }).init();

                $(feesTable.form.modal.getAllTriggerElements()).each((key, element) => {
                    element.addEventListener('click', (ev) => {
                        feesTable.form.modal.setModalTitle(feesTable.rowTitle(ev.target).innerText);
                        feesTable.form.setItemAction(ev.target);
                    })
                });
            }
        }
    })
})();