import { signUpFormFactory } from "./forms/SignUpForm";

var register = (function() {
    var el = document.querySelector('main#signup');
    var signUpForm = null;

    var init = function() {
        setListeners();
    };

    var setRegisterForm = function() {
        if (document.querySelector('#signup-form') !== null) {
            signUpForm = new signUpFormFactory.createForm({
                type: 'sign-up',
                form: document.querySelector('#signup-form')
            });

            signUpForm.updateFieldset()
        }
    };

    var setListeners = function() {
        window.addEventListener('load', (e) => {
            setRegisterForm();
        });
    };

    init()
})();