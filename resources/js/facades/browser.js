import dom from '../facades/dom';
import str from '../facades/str';

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
        getTotalHeightScrolled: function() {
            return window.pageYOffset + window.innerHeight
        },
        scrollSmoothlyTo: function(direction, position) {
            let properties = {};

            properties['scroll' + str.capitalizeFirst(direction)] = position;

            $("html").animate(properties, 500, 'swing');
        },
        isElementScrolledIntoView: function(el) {
            let viewportBottom = $(window).scrollTop() + $(window).height();

            if (dom.isElement(el)) {
                let elBottom = $(el).offset().top + el.clientHeight;

                return (
                    (elBottom >= $(window).scrollTop()) &&
                    ($(el).offset().top <= viewportBottom) &&
                    (elBottom <= viewportBottom) &&
                    ($(el).offset().top >= $(window).scrollTop())
                );
            }

            let coordinates = typeof el == 'object' ? el : false;

            if (coordinates) {
                return (
                    (coordinates.bottom >= $(window).scrollTop()) &&
                    (coordinates.top <= viewportBottom) &&
                    (coordinates.bottom <= viewportBottom) &&
                    (coordinates.top >= $(window).scrollTop())
                )
            }

            return coordinates;


        },
        isElementVisible: function(el) {
            if (typeof jQuery === 'function' && el instanceof jQuery) {
                el = el[0];
            }

            var rect = el.getBoundingClientRect();

            return this.getTotalHeightScrolled() >= rect.top;
        },
        isElementInViewport: function(el) {
            if (typeof jQuery === 'function' && el instanceof jQuery) {
                el = el[0];
            }

            var rect = el.getBoundingClientRect();

            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            )
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
        },
        preventScrolling: function() {
            var position = $(document).scrollTop();

            setTimeout(function() {
                window.scrollTo(0, position);
            }, 0);
        },
    }
}());

export default browser;