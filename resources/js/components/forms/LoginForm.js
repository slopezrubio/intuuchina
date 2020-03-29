import { FormFactory } from "../../factories/FormsFactory";
import { modalsFactory } from '../Modal';

function LoginForm(options) {
    this.fields = {};

    this.modal = options.modal ? options.modal : null;

    this.init = function() {
        this.fields.email = this.el.querySelector('#login-email');
        this.fields.password = this.el.querySelector('#login-password');
        this.fields.token = this.el.querySelector('[name=_token]');

        this.setModal();
    };

    this.setModal = function() {
        if (this.modal !== null) {
            this.modal = modalsFactory.createModal({
                el: this.modal,
                autofocus: true,
            })
        }

        return this;
    };
}

export var loginFormFactory = new FormFactory();

export default LoginForm;