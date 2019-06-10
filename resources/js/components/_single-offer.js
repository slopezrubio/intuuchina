let singleOffer = {
    init: () => {
        window.addEventListener('load', singleOffer.setup);
    },
    currentViewport: window.innerWidth,
    currentScrollY: window.scrollY,
    setup: () => {
        window.addEventListener('resize', function() {
            singleOffer.currentViewport = singleOffer.getViewport();
        });

        window.addEventListener('scroll', function() {
            singleOffer.currentScrollY = singleOffer.getScrollY();
            singleOffer.toggleFixedButton();
        })
    },
    getScrollY: () => {
        return window.scrollY;
    },
    getViewport: () => {
        return window.innerWidth;
    },
    toggleFixedButton: () => {
        //if (singleOffer.getScrollY() >= );
    }
};

if (document.querySelector('#job-description') !== null) {
    singleOffer.init();
}