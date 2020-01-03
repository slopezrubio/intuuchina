var MediaQueries = (function() {
    var instance;

    function init() {
        // Private properties
        var smallDevices = '(max-width: 680px)';
        var customerJourney = '(min-width: 460px)';
        var mediumDevices = '(min-width: 681px)';
        var largeDevices = '(min-width: 993px)';
        var navbarBreakpoint = '(min-width: 992px)';

        // Private methods
        return {
            // Public properties


            // Public methods
            get: function(key) {
                return eval(key);
            },

            isNavbarBreakpoint: function() {
                return window.matchMedia(this.get('navbarBreakpoint')).matches;
            },
            isSmallDevice: function() {
                return window.matchMedia(this.get('smallDevices')).matches;
            },
            isMediumDevice: function() {
                return window.matchMedia(this.get('mediumDevices')).matches;
            },
            isCustomerJourney: function() {
                return window.matchMedia(this.get('customerJourney')).matches;
            },
            isLargeDevice: function() {
                return window.matchMedia(this.get('largeDevices')).matches;
            },
        };
    }

    return {
        getInstance: function() {
            if (!instance) {
                instance = init();
            }

            return instance;
        }
    }
})();

export default MediaQueries.getInstance();

// let breakpoints = {
//     heights: {
//         smallDevices: 156,
//         mediumDevices: 146,
//         largeDevices: 100
//     },
//     widths: {
//         smallDevices: [0, 680],
//         customerJourney: [0, 460],
//         mediumDevices: [681, 992],
//         largeDevices: [993]
//     },
//     isLargeDevice: () => {
//         return window.innerWidth >= breakpoints.widths.largeDevices[0];
//     },
//     isMediumDevice: () => {
//         return window.innerWidth >= breakpoints.widths.mediumDevices[0] && window.innerWidth < breakpoints.widths.mediumDevices[1];
//     },
//     isSmallDevice: () => {
//         return window.innerWidth >= 0 && window.innerWidth < breakpoints.widths.smallDevices[1];
//     },
//     isCustomerJourney: () => {
//         return window.innerWidth >= 0 && window.innerWidth < breakpoints.widths.customerJourney[1];
//     }
//
// };
//
// export default breakpoints;