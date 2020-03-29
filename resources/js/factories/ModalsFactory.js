import Modal from '../components/Modal'

export function ModalFactory() {};

ModalFactory.prototype.modalClass = null;

ModalFactory.prototype.createModal = function(options) {
    this.modalClass = options.el !== null ? Modal : null;

    return this.modalClass !== null ? new this.modalClass(options) : null;
}