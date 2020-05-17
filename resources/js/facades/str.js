var str = (function() {
    var _ = {
        init: function() {

        },
    };

    _.init();

    return {
        convertToString: function(str) {
            if (str) {
                if (typeof str === 'string') {
                    return str;
                }

                return String(str);
            }

            return null;
        },
        toWords: function(str) {
            str = this.convertToString(str);

            var regexp = /[A-Z\xC0-\xD6\xD8-\xDE]?[a-z\xDF-\xF6\xF8-\xFF]+|[A-Z\xC0-\xD6\xD8-\xDE]+(?![a-z\xDF-\xF6\xF8-\xFF])|\d+/g;

            return str.match(regexp);
        },
        titleCase: function(str) {
            let result = '';

            for (let i = 0, words = this.toWords(str); i < this.toWords(str).length; i++) {
                let currentStr = words[i].substr(0, 1).toUpperCase() + words[i].substr(1);

                if (i !== words.length - 1) {
                    currentStr += '';
                }

                result += currentStr;
            }

            return result;
        },
        camelCase: function(str) {

            let result = "";

            for (let i = 0, words = this.toWords(str); i < this.toWords(str).length; i++) {
                let currentStr = words[i];

                let tempStr = currentStr.toLowerCase();

                if (i !== 0) {
                    tempStr = tempStr.substr(0, 1).toUpperCase() + tempStr.substr(1);
                }

                result += tempStr;
            }

            return result;

            // return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function(word, index) {
            //     return index === 0 ? word.toLowerCase() : word.toUpperCase();
            // }).replace(/\s+|_*/g, '');
        },
        kebabCase: function(str) {
            return str.replace(/\s+/g, '-').toLowerCase();
        },
        capitalizeFirst: function(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },
    }
}());

export default str;