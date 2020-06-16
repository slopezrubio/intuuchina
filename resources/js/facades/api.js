import axios from 'axios';

var api = (function() {
    var _ = {
        routes: {
            hostname: window.location.protocol + '//' + window.location.hostname,
            offers: '/internship',
            learn: '/learn',
            payment_method: '/payment-method',
            rates: 'https://api.exchangeratesapi.io/latest?base=EUR',
            paid: '/paid',
            payments: {
                study: 'payments/study',
            },

},
        getParams: function(url = window.location.search) {
            let params = {};
            if (url.charAt(0) !== '?') {
                url = url.split('?', 2)[1];
            }

            url.substring(1)
                .split('&')
                .forEach(function(param) {
                    params[param.split('=')[0]] = param.split('=')[1];
                });

            return params;
        },
    };

    return {
        jQueryGet: function(url, data = null, params = null, callback = null) {
            if (params !== null) {
                url = this.setLaravelParams(url, params);
            }

            console.log(url);

            $.get({
                url: url,
                cache: false,
                data: data !== null ? data : null,
                dataType: 'json',
                error: function(xhr, status, error) {
                    console.log(error);
                },
                success: function(data, status, xhr) {
                    if (callback !== null) {
                        console.log(data);
                        return callback(data);
                    }

                    console.log(data);
                    return data;
                }
            });
        },
        setParams: function(url, params = {}) {
            if (params.length === 0) {
                return url;
            }

            Object.keys(params).forEach(function(key, index) {
                if (params[key] !== null) {
                    if (index === 0) {
                        url += '?';
                    }

                    url = url.concat(key, '=', params[key]);
                }
            });

            return url;
        },
        validate: async function(validationObject) {
            let validationURL = '/validate/' + validationObject.name;

            return await this.axiosRequest(validationURL, 'post', validationObject)
        },
        fetchExternalApi: function(url, data = null, method = 'get') {
            return $.ajax({
                url: url,
                cache: false,
                data: data,
                dataType: 'json',
                error: function(xhr, status, error) {
                    console.log(error);
                },
            });
        },
        getToken: function() {
            return document.head.querySelector('meta[name="csrf-token"').getAttribute('content');
        },
        axiosRequest: async function(url, method = 'get', data = null) {
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

            if (method === 'post') {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = this.getToken();
            }

            try {
                const response = await axios({
                    method: method,
                    url: url,
                    data: data
                });

                console.log(response.data);

                return await response.data;
            } catch(error) {
                // console.log(error.response);
                if (error.response.status === 422) {
                    console.log(error.response.data);
                    return error.response.data;
                }

                return await error.response;
            }
        },
        getRoute: function(name) {
            return _.routes[name];
        },
        getResource: function(resource, value = null) {
            if (value !== null) {
                return this.getRoute('hostname') + '/api/' + resource + '/' + value;
            }

            return this.getRoute('hostname') + '/api/' + resource
        },
        setLaravelParams: function(url, params = []) {
            if (params.length === 0) {
                return url;
            }

            params.forEach(function(param) {
                if (param !== null) {
                    url = url.concat('/', param);
                }
            });

            return url;
        },
    }
}());

export default api;