import api from './api';

var money = (function() {
    var _ = {

    };

    return {
        getRates: function() {
            return api.fetchExternalApi(api.getRoute('rates'));
        },
        exchangeCurrency: async function(value, to, from = 'EUR') {

            let rates = await this.getRates().then((response) => {
                return response.rates;
            });

            if (to.toUpperCase() !== 'EUR') {
                // console.log(value + ' ' + rates[to.toUpperCase()]);
                return value * rates[to.toUpperCase()];
            }

            return value;
        }
    }
}());

export default money;