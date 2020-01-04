import api from './api';

var Money = (function() {
    var instance;

    function MoneyClass(currencies) {
        // Private properties
        var _ratesURL = 'https://reqres.in/api/users?page=2';
        var rates = null;

        async function init() {
            _getRates().then((response) => {
                console.log(response.data);
            }).catch((error) => {
                console.log(error.response);
            });
        }

        async function _getRates() {
            return await axios.get(_ratesURL, {
                crossDomain: true
            });
        };

        init();

        return {
            currencies: currencies,
            rates: rates,
            currencyExchange: function(value, to, from = 'EUR') {
                to = to.upperCase();

                if (to !== from) {
                    value *= this.rates[to];
                }

                return value;
            }
        }
    }

    return {
        getInstance: function() {
            if (!instance) {
                instance = MoneyClass;
            }

            return instance;
        }
    }
})();

export default Money.getInstance();