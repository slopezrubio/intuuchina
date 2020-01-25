import axios from 'axios';

var api = (function() {
    var _ = {
        routes: {
            offers: '/internship',
            learn: '/learn'
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
    };

    return {
        jQueryGet: function(url, data = null, params = null, callback) {
            if (params !== null) {
                url = _.setLaravelParams(url, params);
            }

            $.get({
                url: url,
                cache: false,
                data: data,
                dataType: 'json',
                error: function(xhr, status, error) {
                    console.log(error);
                },
                success: function(data, status, xhr) {
                    callback(data);
                }
            });
        },
        getRoute: function(name) {
            return _.routes[name];
        }
    }
}());

export default api;