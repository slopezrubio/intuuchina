let offersList = {
    init: () => {
        window.addEventListener('load', offersList.setup);
    },
    inputFilter: document.querySelector('#inputFilter') !== null ? document.querySelector('#inputFilter') : null,
    setup: function() {
        offersList.inputFilter.addEventListener('change', function(event) {
            let selectedFilter = offersList.inputFilter.value;
            let path = `internship/filter=${selectedFilter}`;
            offersList.getRequest(path, selectedFilter);
        });
    },
    getRequest: function(path, data = null) {
        $.get({
            url: path,
            cache: false,
            data: data,
            dataType: 'html',
            error: function(xhr, status, error) {
                console.log(error);
            },
            success: function(data, status, xhr) {
                console.log(data);
            }
        })
    }
};

if (document.querySelector('.offers_list') !== null) {
    offersList.init();
}