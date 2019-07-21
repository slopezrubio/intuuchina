let dom = {
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
    toggleSingleClass: (element, className) => {
        $(element).toggleClass(className);
    },
    expandToViewport: (element) => {
        $(element).width(document.body.clientWidth);
    }
};

export default dom;