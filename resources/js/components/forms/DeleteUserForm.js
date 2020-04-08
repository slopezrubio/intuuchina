import { FormFactory } from '../../factories/FormsFactory';

import { modalsFactory } from "../../components/Modal";

function DeleteUserForm(options) {
    this.fields = {};

    this.init = function() {
        if (this.modal !== null) {
            this.modal = modalsFactory.createModal({
                el: document.getElementById('deleteUserModal'),
            }).init();
        }

        this.fields.token = this.el.querySelector('[name=token]');

        return this;
    };
}

export var deleteUserFormFactory = new FormFactory();

export default DeleteUserForm;