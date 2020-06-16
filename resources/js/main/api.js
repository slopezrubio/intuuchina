let api = {
    confirm: async function(url, data) {
        api.setTokenToAxiosHeader(data);
        try {
            const response = await axios({
                method: 'post',
                url: url,
                data: data,
            });

            return await response.data;
        } catch(error) {
            console.error('Unable to connect to the server');
        }
    },
    getResource: async function(resource, parameters) {
        let requestURL = api.getHostName() + '/api/' + resource;

        Object.keys(parameters).forEach(function(key) {
            requestURL += '/' + parameters[key];
        });

        try {
            const response = await axios({
                method: 'GET',
                url: requestURL,
            });

            return response.data;
        } catch(error) {
            console.log(error);
        }
    },
    getHostName: function() { return window.location.protocol + '//' + window.location.hostname },
    sendPaymentMethod: async function(data) {
        api.setTokenToAxiosHeader();
        try {
            const response = await axios({
                method: 'post',
                url: api.getHostName() + '/payment-method',
                data: data,
            });

            console.log(response);
            return response;
        } catch(error) {
            console.log(error.response);
        }
    },
    getDialog: async function(url, token) {
        try {
            const response = await axios({
                method: 'post',
                url: url,
                data: token
            });

            return await response.data;
        } catch(error) {
            console.log(error.response);
        }
    },
    validate: async function(field) {
        api.setTokenToAxiosHeader();
        const response = await axios({
            method: 'post',
            headers: { 'Content-type' : 'application/json' },
            url: '/validate/' +  field.name,
            data: field
        })
            .then(function(response) { return null; })
            .catch(error => { return error.response.data.errors });

        return await response;
    },
    validateFields: async function(type, object) {
        api.setTokenToAxiosHeader();
        const response = await axios({
            method: 'post',
            headers: { 'Content-type' : 'application/json' },
            url: '/validate/' +  type,
            data: object,
        })
            .then(function(response) { return response.data })
            .catch(error => { console.log(error.response);return error.response.data });

        return await response;
    },
    setTokenToAxiosHeader: function() {
        console.log(api.getToken());
        axios.defaults.headers.common['X-CSRF-TOKEN'] = api.getToken();
    },
    getPagination: function(url, container) {
        if (url !== undefined) {
            let request = {
                url: url.split('page=')[0],
                page: url.split('page=')[1]
            }

            $.get({
                data: {
                    page: request.page
                },
                dataType: 'json',
                cache: false,
                url: request.url,
                error: function(xhr, status, error) {
                    console.log(error);
                },
                success: function(data, status) {
                    $(container.previousElementSibling).remove();
                    $(container).before(data);
                }
            });
        }

        return false;
    },
    getToken: function() {
        return document.head.querySelector('meta[name="csrf-token"').getAttribute('content');
    },
    getCourseInfo: function(category, callback) {
        let data = {
            'category' : category
        };

        $.post({
            url: 'category-info',
            cache: false,
            data: data,
            dataType: 'html',
            headers: {
                'X-CSRF-TOKEN': api.getToken()
            },
            error: function(xhr, status, error) {
                console.log(error);
            },
            success: function(data, status, xhr) {
                callback(data);
            }
        })
    },
};

export default api;
