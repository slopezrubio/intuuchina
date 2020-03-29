import { loginFormFactory } from "../components/forms/LoginForm";

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        var loginForm = loginFormFactory.createForm({
            form: document.getElementById('login'),
            type: 'login',
            modal: document.getElementById('loginModal'),
        }).init();
    })
})();