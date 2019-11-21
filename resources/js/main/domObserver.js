const domObserver = (function() {
    var MutationObserver = window.MutationObserver || window.WebkitMutation.Observer;

    return function(object, callback) {

        // Checks if the Object is an nodeType or a DOM element.
        if (!object || !object.nodeType === 1) return;

        if (MutationObserver) {

            // Define a new observer
            var observer = new MutationObserver(function(mutations, observer) {
                callback(mutations);
            });

            // Adds the DOM element or the nodeType to the list of observed nodes.
            observer.observe(object, {
                childList: true,
                subtree: true
            });
        } else if (window.addEventListener) {
            object.addEventListener('DOMNodeInserted', callback, false);
            object.addEventListener('DOMNodeRemoved', callback, false);
        }
    }
})();

export default domObserver;