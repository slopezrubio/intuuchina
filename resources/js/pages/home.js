import { loginFormFactory } from "../components/forms/LoginForm";
import { infographyFactory } from "../components/Infography";

import api from '../facades/api';

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        var loginForm = loginFormFactory.createForm({
            form: document.getElementById('login'),
            type: 'login',
            modal: document.getElementById('loginModal'),
        }).init();

        if (document.getElementById('home')) {
            loadHeader();
        }

        if (document.getElementById('customer-journey') !== null) {
            var customerJourneyInfography = infographyFactory.createInfography({
                el: document.getElementById('customer-journey').querySelector('.infography')
            }).init();
        }

        function loadHeader() {
            let background = api.getRoute('hostname') + '/storage/images/headers/home.jpg';
            let header = document.querySelector('header');

            const img = new Image();
            img.src = background;

            img.onload = () => {
                header.style.backgroundImage = `url(${background})`;
            };
        }
    })
})();