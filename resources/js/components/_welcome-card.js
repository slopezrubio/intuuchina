const axios = require('axios');

import api from '../main/api';

let welcomeCard = {
    init: function() {
        welcomeCard.setup();
    },
    dialogContainer: document.querySelector('#dialog') ? document.querySelector('#dialog') : null,
    forms: {
        confirm: {
            el: document.querySelector('#confirm') ? document.querySelector('#confirm') : null,
        }
    },
    setup: function() {
        console.log(welcomeCard.forms.confirm.el);
        welcomeCard.forms.confirm.el.addEventListener('submit', async function (event) {
            event.preventDefault();
            let url = event.target.getAttribute('action');
            let data = {
                _token : welcomeCard.forms.confirm.el.querySelector('input[type="hidden"')
            };
            let dialogBox = await api.confirm(url, data);
            welcomeCard.replaceDialog(dialogBox);
        });
    },
    replaceDialog: function(newDialog) {
        let container = welcomeCard.dialogContainer.parentElement;
        $(welcomeCard.dialogContainer).empty();
        $(container).html(newDialog);
    }
    /*replace: function(oldElement, newElement) {
        let container = oldElement.parentElement;
        $(oldElement).empty();

        if (typeof newElement === 'string') {
            $(container).html(newElement);
        }
    },*/
}

if (document.querySelector('.user-card')) {
    welcomeCard.init();
}

