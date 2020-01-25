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
            }
        },

        setBreakpoints: function() {
            Object.keys(this.breakpoints).map(function(breakpoint) {
                _.breakpoints[breakpoint].media = '(' +  _.breakpoints[breakpoint].type + '-width: ' +  _.breakpoints[breakpoint].size + 'px)'
            });
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
            if (_.breakpoints[breakpoint] === undefined) {
                console.log("The given breakpoint name does not exist");
                return null;
            }

            return window.matchMedia(_.breakpoints[breakpoint].media).matches;
        },

    }
}());

export default browser;