var browser = (function() {
    var _ = {
        breakpoints: {
            small: {
                media: null,
                type: 'max',
                size: 680,
            },
            medium: {
                media: null,
                type: 'min',
                size: 460,
            },
            large: {
                media: null,
                type: 'min',
                size: 993,
            },
            navbar: {
                media: null,
                type: 'min',
                size: 992,
            },
            footer: {
                checkbox: {
                    media: null,
                    type: 'min',
                    size: 1118,
                }
            }
        },


        setBreakpoints: function(breakpoints = null) {
            if (breakpoints === null) breakpoints = _.breakpoints;
            Object.keys(breakpoints).map(function(key) {
                if (breakpoints[key].media !== undefined) {
                    breakpoints[key].media = '(' +  breakpoints[key].type + '-width: ' +  breakpoints[key].size + 'px)'
                } else {
                    this.setBreakpoints(breakpoints[key])
                }
            }, this);
        },

        init: function() {
            this.setBreakpoints();
        },
    };

    _.init();

    return {
        isSmallDevice: function() {
            return window.matchMedia(_.breakpoints.small.media).matches;
        },
        isMediumDevice: function() {
            return window.matchMedia(_.breakpoints.small.media).matches;
        },
        isLargeDevice: function() {
            return window.matchMedia(_.breakpoints.small.media).matches;
        },
        matchesGivenBreakpoint: function(breakpoint) {
            if (eval('_.breakpoints.' + breakpoint) === undefined) {
                console.log("The given breakpoint name does not exist");
                return null;
            }

            return window.matchMedia(eval('_.breakpoints.' + breakpoint).media).matches;
        },
        /**
         * Scrolls the window until the given element reaches
         * the bottom of the navbar.
         */
        verticalScrollTo: function(element) {
            // Check if the navbar exist
            if ($('nav').length > 0) {
                $(window).scrollTop(element.clientHeight - $('nav').height());
            }
        }
    }
}());

export default browser;