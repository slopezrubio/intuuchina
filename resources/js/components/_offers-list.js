let offersList = {
    init: () => {
        window.addEventListener('load', offersList.setup);
    },
    inputFilter: document.querySelector('#inputFilter') !== null ? document.querySelector('#inputFilter') : null,
    setup: function() {
        offersList.inputFilter.addEventListener('change', function(event) {
            let selectedFilter = offersList.inputFilter.value;
            let path = window.location.pathname + `/filter=${selectedFilter}`;
            offersList.getRequest(path, selectedFilter);
        });
    },
    render: (parentElement, data) => {
        parentElement.innerHTML = data;
    },
    addRemoveFunction: (arr) => {
        (function (arr) {
            arr.forEach(function (item) {
                if (item.hasOwnProperty('remove')) {
                    return;
                }
                Object.defineProperty(item, 'remove', {
                    configurable: true,
                    enumerable: true,
                    writable: true,
                    value: function remove() {
                        if (this.parentNode !== null)
                            this.parentNode.removeChild(this);
                    }
                });
            });
        })([Element.prototype, CharacterData.prototype, DocumentType.prototype]);
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
                $('.offers').remove();
                $('main').after(data);

                //offersList.render(, data);
            }
        })
    }
};

if (document.querySelector('.offers_list') !== null) {
    offersList.init();
}