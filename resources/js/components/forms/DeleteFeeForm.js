import { FormFactory } from '../../factories/FormsFactory';

import { modalsFactory } from "../../components/Modal";

function DeleteFeeForm(options) {
    this.fields = {};

    this.init = function() {
        if (this.modal !== null) {
            this.modal = modalsFactory.createModal({
                el: document.getElementById('deleteFeeModal'),
            }).init();
        }

        this.fields.token = this.el.querySelector('[name=token]');

        return this;
    };
}

export var deleteFeeFormFactory = new FormFactory();

export default DeleteFeeForm;