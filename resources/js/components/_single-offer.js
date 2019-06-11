let singleOffer = {
    init: () => {
        window.addEventListener('load', singleOffer.setup);
    },
    currentViewport: window.innerWidth,
    currentScrollY: window.scrollY,
    setup: () => {
        singleOffer.setImages();
        window.addEventListener('resize', function() {
            singleOffer.currentViewport = singleOffer.getViewport();
        });

        window.addEventListener('scroll', function() {
            singleOffer.currentScrollY = singleOffer.getScrollY();
            singleOffer.toggleFixedButton();
        })
    },
    setImages: function() {
        let picture = singleOffer.getDataContent(document.querySelector('.card_background-image'));
        singleOffer.setProperty(document.querySelector('.card_background-image'), 'background-image', `url('${picture}')`);
    },
    getScrollY: () => {
        return window.scrollY;
    },
    getViewport: () => {
        return window.innerWidth;
    },
    getDataContent: (element) => {
        return $(element).attr('data-content');
    },
    setProperty: (element, property, value) => {
        element.style.setProperty(property,value);
    },
    toggleFixedButton: () => {
        let lastSection = ($('main .readable_section').last());
        let firstIndex = 0;
        let position = lastSection[firstIndex].clientHeight + lastSection[firstIndex].offsetTop;
        if (singleOffer.theViewportPassedOverHere(position)) {
            if (document.querySelector('.sendable_section--fixed')) {
                let applyNowButton = document.querySelector('.sendable_section--fixed');
                $(applyNowButton).toggleClass('sendable_section--fixed');
                $(applyNowButton).toggleClass('sendable_section');
                position = window.scrollY + (applyNowButton.clientHeight * 2);
                singleOffer.scrollTo(position);
            }
        } else {
            if (document.querySelector('.sendable_section')) {
                let applyNowButton = document.querySelector('.sendable_section');
                $(applyNowButton).toggleClass('sendable_section');
                $(applyNowButton).toggleClass('sendable_section--fixed');
            }
        }
    },
    scrollTo: (position) => {

        $("html").animate({
            'scrollTop': position,
        }, 500, 'swing');
    },
    theViewportPassedOverHere: (y) => {
        return window.pageYOffset + window.innerHeight >= y;
    }
};

if (document.querySelector('#job-description') !== null) {
    singleOffer.init();
}