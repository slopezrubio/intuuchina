import { ModalFactory } from "../factories/ModalsFactory";

function Modal(options) {
    this.el = options.el;
    this.autofocus = options.autofocus ? options.autofocus : false;

    this.init = function() {
        $(this.el).on('shown.bs.modal', (event) => this.setAutofocus(event));

        return this;
    };

    this.setAutofocus = function(event) {
        if (this.autofocus) {
            $(this.el).find(".modal-body :input:not([type=hidden])")[0].focus()
        }

        return this;
    };

    this.getAllTriggerElements = function() {
        return $('[data-target="#' + this.el.getAttribute('id') + '"]');
    };

    this.setModalTitle = function(title) {
        this.el.querySelector('.modal-title').innerText = title;
    };

    this.init();
}

export var modalsFactory = new ModalFactory();

export default Modal;