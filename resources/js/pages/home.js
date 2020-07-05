import { loginFormFactory } from "../components/forms/LoginForm";
import { infographyFactory } from "../components/Infography";

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        var loginForm = loginFormFactory.createForm({
            form: document.getElementById('login'),
            type: 'login',
            modal: document.getElementById('loginModal'),
        }).init();

        if (document.getElementById('customer-journey') !== null) {
            var customerJourneyInfography = infographyFactory.createInfography({
                el: document.getElementById('customer-journey').querySelector('.infography')
            }).init();
        }
    })
})();