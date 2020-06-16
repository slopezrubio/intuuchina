import { upgradeUserFormFactory } from "../../components/forms/UpgradeUserForm";

window.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('main#upgrade') !== null) {
        var userUpgradeForm = upgradeUserFormFactory.createForm({
            form: document.getElementById('upgrade-user'),
            type: 'upgrade-user',
        }).init();

        console.log(userUpgradeForm);
    }
});