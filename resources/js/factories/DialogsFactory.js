import Dialog from '../components/Dialog'

export function DialogFactory() {}

DialogFactory.prototype.dialogClass = null;

DialogFactory.prototype.createDialog = function(options) {
    this.dialogClass = document.getElementById('dialog-box') !== null
                        ? Dialog : null;

    return this.dialogClass !== null ? new this.dialogClass(options) : null;
};