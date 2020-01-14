import DOM from '../main/dom';
import api from '../main/api';


var Pagination = (function() {
    var instance;

    function PaginationClass(options) {
        // Private properties
        var _container = options.container;
        var _links = options.container.querySelectorAll('.page-link');
        var _selector = options.container.querySelector('.item-selector');
        var _controllers = {
            next: _links[_links.length - 1],
            previous: _links[0]
        };
        var _path = _controllers.previous.getAttribute('href')
                    ? _controllers.previous.getAttribute('href').split('page=')[0]
                    : _controllers.next.getAttribute('href').split('page=')[0];

        // Private methods
        function init() {
            slideTo(getCurrentLink().offsetLeft - _selector.offsetLeft);

            _links.forEach(function (element) {
                element.addEventListener('click', getPage)
            });
        }

        function getPage(e) {
            e.preventDefault();

            if (isCurrentLink(e.target)) {
                return false;
            }

            // if (e.target.offsetLeft === _selector.offsetLeft || DOM.isDisabled(e.target)) {
            //     console.log("hola");
            //     return false;
            // }

            api.getPagination(e.target.getAttribute('href'), _container);

            moveSelectorTo(e.target);
        }

        function moveSelectorTo(linkSelected) {
            let moveTo = false;

            let rel = linkSelected.getAttribute('rel');

            if (rel !== null) {
                let selected = eval('get' + rel[0].toUpperCase() + rel.slice(1) + '(getCurrentLink())');
                if (selected.getAttribute('rel') === null) {
                    moveTo = selected.offsetLeft - _selector.offsetLeft;
                    setCurrentLink(selected);
                    updateControllers();
                    slideTo(moveTo);
                }

                return moveTo;
            }

            moveTo = linkSelected.offsetLeft - _selector.offsetLeft;
            setCurrentLink(linkSelected);
            updateControllers();
            slideTo(moveTo);

            return true
        }

        function slideTo(x) {
            x += 'px';

            $(_selector).css({
                '-webkit-transform': 'translateX(' + x + ')',
                '-moz-transform': 'translateX(' + x + ')',
                '-ms-transform': 'translateX(' + x + ')',
                '-o-transform': 'translateX(' + x + ')',
                'transform': 'translateX(' + x + ')'
            });
        }

        /**
         * Gets the next link from the current one.
         *
         * @param element
         * @returns {Element}
         */
        function getNext(element) {
            return element.parentElement.nextElementSibling.querySelector('.page-link');
        }

        /**
         * Gets the previous link from the current one.
         *
         * @param element
         * @returns {Element}
         */
        function getPrev(element) {
            return element.parentElement.previousElementSibling.querySelector('.page-link')
        }

        function isCurrentLink(anchor) {
            return anchor.isEqualNode(getCurrentLink());
        }

        function updateControllers() {
            updateLinks();
            let container = _controllers.previous.parentElement;
            if (isFirstPage()) {
                if (!$(container).hasClass('disabled')) {
                    container.classList.add('disabled');
                    container.setAttribute('aria-disabled', 'true');
                    container.innerHTML = '<span class="page-link" aria-hidden="true">‹</span>';
                }
            } else {
                if ($(container).hasClass('disabled')) {
                    container.classList.remove('disabled');
                    container.removeAttribute('aria-disabled');
                }

                container.innerHTML = '<a class="page-link" href="' + _path + 'page=' + getPrev(getCurrentLink()).textContent + '" rel="prev" aria-label="Previous »">‹</a>';
            }
            _controllers.previous = container.querySelector('.page-link');
            _controllers.previous.addEventListener('click', getPage);

            container = _controllers.next.parentElement;
            if (isLastPage()) {
                if (!$(container).hasClass('disabled')) {
                    container.classList.add('disabled');
                    container.setAttribute('aria-disabled', 'true');
                    container.innerHTML = '<span class="page-link" aria-hidden="true">›</span>';
                }
            } else {
                if ($(container).hasClass('disabled')) {
                    container.classList.remove('disabled');
                    container.removeAttribute('aria-disabled');
                }

                container.innerHTML = '<a class="page-link" href="' + _path + 'page=' + getNext(getCurrentLink()).textContent + '" rel="next" aria-label="Next »">›</a>';
            }

            _controllers.next = container.querySelector('.page-link');
            _controllers.next.addEventListener('click', getPage);
        }

        /**
         * Sets the element passed an argument as the current link.
         *
         * @param element
         */
        function setCurrentLink(element) {
            getCurrentLink().parentElement.innerHTML = '<a class="page-link" href="' + _path + 'page=' + getCurrentLink().textContent + '">' + getCurrentLink().textContent + '</a>';
            getCurrentLink().addEventListener('click', getPage);
            getCurrentLink().parentElement.removeAttribute('aria-current');

            DOM.toggleSingleClass(getCurrentLink().parentElement, 'active');
            DOM.toggleSingleClass(element.parentElement, 'active');

            element.parentElement.setAttribute('aria-current', 'page');
            element.parentElement.innerHTML = '<span class="page-link">' + element.textContent + '</span>'
        }

        function isFirstPage() {
            return getCurrentLink().isEqualNode(_links[1]);
        }

        function isLastPage() {
            return getCurrentLink().isEqualNode(_links[_links.length - 2]);
        }

        function updateLinks() {
            _links = _container.querySelectorAll('.page-link');
        }

        function getCurrentLink() {
            return _container.querySelector('.active > .page-link');
        }

        init();

        return {
            hasPagination: () => {
                return document.querySelector('.pagination')
            },

            get: (key) => {
                return this[key];
            },

            set: (key, value) => {
                this[key] = value;
            }
        }
    }

    return {
        getInstance: function() {
            if (!instance) {
                instance = PaginationClass;
            }

            return instance;
        }
    }
})();

export default Pagination.getInstance();