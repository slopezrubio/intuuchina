let messages = {
    form: {
        labels : [

        ],
        inputs : [

        ],
        errors : [

        ],
        advices: {
            removeOffer: function(value) {
                return `Are you sure you want to remove permanently ${value} offer?`;
            }
        }
    }
}

export default messages;