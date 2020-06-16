import { FormFactory } from "../../factories/FormsFactory";

function UpgradeUserForm() {
    this.fields = {};

    this.editor = null;

    this.init = function() {
        this.fields.message = this.el.querySelector('#message');
        this.editor = this.el.querySelector('#message-editor');
        this.editor = this.mountWYSIWYGEditor();

        this.el.addEventListener('submit', (ev) => {
            this.fields.message.value = JSON.stringify(this.editor.getContents());
        })

        return this;
    }
}

export var upgradeUserFormFactory = new FormFactory();

export default UpgradeUserForm;