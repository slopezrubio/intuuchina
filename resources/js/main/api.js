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
    validate: async function(field) {
        api.setTokenToAxiosHeader();
        const response = await axios({
            method: 'post',
            headers: { 'Content-type' : 'application/json' },
            url: '/validate/' +  field.name,
            data: field
        })
            .then(function(response) { console.log(response.data); return null })
            .catch(error => { console.log(error.response); return error.response.data.errors });

        return await response;
    },
    setTokenToAxiosHeader: function() {
        var token = document.head.querySelector('meta[name="csrf-token"');
        axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    }
};

export default api;
