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
    breakpointsHeights: {
        smallDevices: 136,
        mediumDevices: 226,
        largeDevices: 100
    },
    breakpoints: {
        smallDevices: [100, 680],
        mediumDevices: [681, 992],
        largeDevices: [993]
    },
    setup: () => {
        news.currentBreakpoint = news.getBreakpoint();
        news.wrapBackground();
    },
    getBreakpoint: () => {
        let currentWidth = window.innerWidth;
        let breakpointKey = 'largeDevices';
        Object.keys(news.breakpoints).map(function(key, index) {
            if (news.breakpoints[key][1] > currentWidth && news.breakpoints[key][0] < currentWidth) {
                breakpointKey = key;
            }
        });
        return breakpointKey;
    },
    wrapBackground: () => {
        let toResize = news.breakpointsHeights[news.currentBreakpoint] + news.polygon.clientHeight;
        news.polygon.style.height = toResize + 'px';
    }
};


if (news.polygon !== null) {
    news.init();
}