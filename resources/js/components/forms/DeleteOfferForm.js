import { FormFactory } from '../../factories/FormsFactory';

import { modalsFactory } from "../../components/Modal";

function DeleteOfferForm(options) {
    this.fields = {};

    this.init = function() {
        if (this.modal !== null) {
            this.modal = modalsFactory.createModal({
                el: document.getElementById('deleteOfferModal'),
            }).init();
        }

        this.fields.token = this.el.querySelector('[name=token]');

        return this;
    };
}

export var deleteOfferFormFactory = new FormFactory();

export default DeleteOfferForm;