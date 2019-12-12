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
    getHostName: function() { return window.location.protocol + '//' + window.location.hostname },
    sendPaymentMethod: async function(data) {
        api.setTokenToAxiosHeader(data);
        try {
            const response = await axios({
                method: 'post',
                url: api.getHostName() + '/payment-method',
                data: data,
            });

            return response;
        } catch(error) {
            console.log(error);
        }
    },
    continue: async function(url) {
        try {
            const response = await axios({
                method: 'get',
                url: url
            });

            return await response.data;
        } catch(error) {
            console.log(error);
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
            .then(function(response) { return null })
            .catch(error => { return error.response.data.errors });

        return await response;
    },
    validateObject: async function(object) {
        api.setTokenToAxiosHeader();
        const response = await axios({
            method: 'post',
            headers: { 'Content-type' : 'application/json' },
            url: '/validate/' +  object.type,
            data: object[object.type],
        })
            .then(function(response) { return null })
            .catch(error => { return error.response.data.errors });

        return await response;
    },
    setTokenToAxiosHeader: function() {
        var token = document.head.querySelector('meta[name="csrf-token"');
        axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    }
};

export default api;
