import { editFeeFormFactory } from "../../components/forms/EditFeeForm";

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('fee') !== null) {
            var editUserForm = editFeeFormFactory.createForm({
                form: document.getElementById('edit-fee'),
                type: 'edit-fee',
            }).init();
        }
    })
})();