import { DialogFactory } from "../factories/DialogsFactory";

function Dialog(options) {
    this.el = document.getElementById('dialog-box');
    this.container = this.el.children[0];

    /**
     * Replace the dialog by the HTML content passed as
     * an argument.
     *
     * @param content
     */
    this.replace = function(content) {
        let header = this.el.parentElement;

        $(this.el).remove();
        $(header).append(content);

        return dialogFactory.createDialog();
    }
}

export var dialogFactory = new DialogFactory();

export default Dialog;