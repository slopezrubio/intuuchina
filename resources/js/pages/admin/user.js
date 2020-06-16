import { editUserFormFactory } from "../../components/forms/EditUserForm";

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('user') !== null) {
            var editUserForm = editUserFormFactory.createForm({
                form: document.getElementById('edit-user'),
                type: 'edit-user',
            }).init();
        }
    })
})();