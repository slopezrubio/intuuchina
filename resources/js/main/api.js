let api = {
    confirm: async function(url, data) {
        api.setTokenToAxiosHeader(data);
        try {
            const response = await axios({
                method: 'post',
                url: url,
                data: data,
            })

            return await response.data;
        } catch(error) {
            console.error('Unable to connect to the server');
        }
    },
    setTokenToAxiosHeader: function() {
        var token = document.head.querySelector('meta[name="csrf-token"');
        axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    }
};

export default api;