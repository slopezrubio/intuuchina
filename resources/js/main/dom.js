let dom = {
    setProperty: function(element, property, value) {
        element.style[property] = value;
    },
    getProperty: function(element, property) {
        return element.style.getPropertyValue(property);
    },
    toggleClass: (element, firstClassName, secondClassName) => {
        $(element).toggleClass(firstClassName);
        $(element).toggleClass(secondClassName);
    },
    toggleSingleClass: (element, className) => {
        $(element).toggleClass(className);
    },
    expandToViewport: (element) => {
        $(element).width(document.body.clientWidth);
    }
};

export default dom;