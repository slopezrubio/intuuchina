import MediaQueries from '../main/breakpoints';

let news = {
    init: () => {
        window.addEventListener('load', news.setup);
        window.addEventListener('resize', function() {
            news.polygon.style.height = 'auto';
            news.setup();
        });
    },
    polygon: document.querySelector('.news'),
    currentBreakpoint: null,
    setup: () => {
        //news.currentBreakpoint = news.getBreakpoint();
    },
    getBreakpoint: () => {
        let currentWidth = window.innerWidth;
        let breakpointKey = 'largeDevices';
        /*Object.keys(breakpoints.widths).map(function(key) {
            if (breakpoints.widths[key][1] > currentWidth && breakpoints.widths[key][0] < currentWidth) {
                breakpointKey = key;
            }
        });
        return breakpointKey;*/
    },
};

if (news.polygon !== null) {
    news.init();
}

export default news;