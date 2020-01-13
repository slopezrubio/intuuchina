var DOM = (function() {
    var instance;

    function init() {
        // Private properties

        // Private methods
        return {
        // Public properties

        // Public methods
            setProperty: function(element, property, value) {
                element.style[property] = value;
            },
            getProperty: function(element, property) {
                return element.style.getPropertyValue(property);
            },
            resetProperty: function(element, property) {
                element.style[property] = '';
            },
            toggleClass: (element, firstClassName, secondClassName) => {
                $(element).toggleClass(firstClassName);
                $(element).toggleClass(secondClassName);
            },
            removeSingleClass: (element, className) => {
                $(element).removeClass(className);
            },
            expandToViewport: (element) => {
                $(element).width(document.body.clientWidth);
            },
            toggleSingleClass: (element, className) => {
                $(element).toggleClass(className);
            },
            getHighestElement: (elements) => {
                let elementsHeight = [];
                for (let i = 0; i < elements.length; i++) {
                    elementsHeight.push(elements[i].clientHeight);
                }

                return elements[elementsHeight.indexOf(Math.max.apply(null, elementsHeight))];
            },
            isDisabled: (element) => {
                return element.getAttribute('disabled') || element.getAttribute('aria-disabled');
            },
            hide: (element) => {
                element.classList.add('hidden')
                element.setAttribute('aria-hidden', true)
            },
            show: (element) => {
                element.classList.remove('hidden')
                element.setAttribute('aria-hidden', false)
            }
        }
    };

    return {
        getInstance: function() {
            if (!instance) {
                instance = init();
            }

            return instance;
        }
    }
})();

export default DOM.getInstance();