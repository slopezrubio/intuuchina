import {editUserFormFactory} from "../../components/forms/EditUserForm";

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        if (document.querySelector('main#dashboard') !== null) {
            if (document.querySelector('#profile-content-tab')) {
                var editUserForm = editUserFormFactory.createForm({
                    form: document.getElementById('edit-user'),
                    type: 'edit-user',
                }).init();
            }
        }
    })
})();