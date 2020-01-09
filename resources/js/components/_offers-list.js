import messages from '../main/messages';
import Pagination from './Pagination';
import domObserver from '../main/domObserver.js';

let offersList = {
    init: () => {
        window.addEventListener('load', offersList.setup);
        if (document.querySelector('.pagination')) {
            offersList.pagination = new Pagination({
                container: document.querySelector('.pagination')
            });
        }
    },
    inputFilter: document.querySelector('#inputFilter') !== null ? document.querySelector('#inputFilter') : null,
    modalOffer: document.querySelector('#modalOffer') !== null ? document.querySelector('#modalOffer') : null,
    deleteButtons: document.querySelectorAll('.delete') !== null ? document.querySelectorAll('.delete') : null,
    pagination: null,
    setup: function() {
        offersList.inputFilter.addEventListener('change', function(event) {
            let selectedFilter = offersList.inputFilter.value;
            let path = selectedFilter !== 'all' ? window.location.pathname + `/${selectedFilter}` : window.location.pathname;
            offersList.getRequest(path, {
                isNewFilter: 'true',
            });
        });

        for (let i = 0; i < offersList.deleteButtons.length; i++) {
            offersList.deleteButtons[i].addEventListener('click', function() {
                offersList.loadModalData(this);
            })
        }
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
    loadModalData: function(element) {
        let chosenOffer = element.getAttribute('data-value');
        let modalForm = document.querySelector('#removeOffer');
        modalForm.setAttribute('action', modalForm.getAttribute('action').replace(/[0-9]+$/, chosenOffer));
        let offerTitle = $(element).parent().parent().siblings('.card-title').text();
        document.querySelector('.modal-body__text').innerHTML = messages.form.advices.removeOffer(offerTitle);
    },
    getRequest: function(path, data = null) {
        $.get({
            url: path,
            cache: false,
            data: data,
            dataType: 'json',
            error: function(xhr, status, error) {
                console.log(error);
            },
            success: function(data, status, xhr) {
                $('#content').html(data);
                if (offersList.pagination.hasPagination()) {
                    offersList.pagination = new Pagination({
                        container: document.querySelector('.pagination')
                    });
                }
            }
        })
    }
};

if (document.querySelector('.offers_list') !== null) {
    offersList.init();
}