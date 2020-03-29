import browser from "./browser";

var dom = (function() {
    var _ = {
        isNodeList: function(nodes) {
            return NodeList.prototype.isPrototypeOf(nodes);
        },
        isHTMLCollection: function(collection) {
            return HTMLCollection.prototype.isPrototypeOf(collection);
        }
    };

    return {
        toggleVisibility: function( element ) {
            if (element.style.display === "none") {
                this.show(element);
            } else {
                this.hide(element)
            }
        },
        hide: function( elements ) {
            let element = null;

            if (elements === null) {
                return false;
            }

            // Check if the element is not iterable
            if (elements == null || typeof elements[Symbol.iterator] !== 'function') {
                element = elements;
            }

            if (element !== null) {
                element.style.display = 'none';
                if (element.hasAttribute('aria-hidden')) {
                    element.setAttribute('aria-hidden', 'true')
                }
                return this;
            }

            for (let i = 0; i < elements.length; i++) {
                elements[i].style.display = 'none';
                if (elements[i].hasAttribute('aria-hidden')) {
                    elements[i].setAttribute('aria-hidden', 'true')
                }
            }

            return this;
        },
        show: function( elements, displayValue = 'block' ) {
            let element = null;

            if (elements === null) {
                return false;
            }

            // Check if the element is not iterable
            if (elements == null || typeof elements[Symbol.iterator] !== 'function') {
                element = elements;
            }

            if (element !== null) {
                element.style.display = element.style.display === 'none' ? '' : element.style.display;
                if (element.hasAttribute('aria-hidden')) {
                    element.setAttribute('aria-hidden', 'false')
                }
                return this;
            }

            for (let i = 0; i < elements.length; i++) {
                elements[i].style.display = elements[i].style.display === 'none' ? '' : elements[i].style.display;
                if (elements[i].hasAttribute('aria-hidden')) {
                    elements[i].setAttribute('aria-hidden', 'false')
                }
            }

            return this;
        },
        clearContent: function( element ) {
            element.textContent ? element.textContent = '' : element.innerText = '';
            return this;
        },
        replaceElements: function(replacement, replaced) {

        },
        isElement: function(obj) {
            var tag = obj.tagName;
            try {
                obj.tagName = '';  // Read-only for DOM, should throw exception
                obj.tagName = tag; // Restore for normal objects
                return false;
            } catch (e) {
                return true;
            }
        }
    }
}());

export default dom;