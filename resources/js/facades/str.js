var str = (function() {
    var _ = {
        init: function() {

        },
    };

    _.init();

    return {
        camelCase: function(str) {
            return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function(word, index) {
                return index === 0 ? word.toLowerCase() : word.toUpperCase();
            }).replace(/\s+/g, '');
        },
        kebabCase: function(str) {
            return str.replace(/\s+/g, '-').toLowerCase();
        },
        capitalizeFirst: function(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    }
}());

export default str;