import { ModalFactory } from "../factories/ModalsFactory";

function Modal(options) {
    this.el = options.el;
    this.autofocus = options.autofocus ? options.autofocus : false;

    this.init = function() {
        $(this.el).on('shown.bs.modal', (event) => this.setAutofocus(event));
    };

    this.setAutofocus = function(event) {
        if (this.autofocus) {
            $(this.el).find(".modal-body :input:not([type=hidden])")[0].focus()
        }

        return this;
    };

    this.init();
}

export var modalsFactory = new ModalFactory();

export default Modal;