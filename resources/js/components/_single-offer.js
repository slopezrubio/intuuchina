import dom from '../main/dom';

let singleOffer = {
    init: () => {
        window.addEventListener('load', singleOffer.setup);
    },
    currentViewport: window.innerWidth,
    currentScrollY: window.scrollY,
    setup: (event) => {
        singleOffer.setImages();
        window.addEventListener('resize', function() {
            singleOffer.currentViewport = singleOffer.getViewport();
        });

        singleOffer.toggleFixedButton(event);

        window.addEventListener('scroll', function(event) {
            singleOffer.currentScrollY = singleOffer.getScrollY();
            singleOffer.toggleFixedButton(event);
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
    toggleFixedButton: (event) => {
        let lastSection = ($('.readable_section').last());

        let firstIndex = 0;;
        let position = $(lastSection[firstIndex]).offset().top + lastSection[firstIndex].clientHeight;
        if (singleOffer.theViewportPassedOverHere(position)) {
            if (document.querySelector('.sendable_section--fixed')) {
                let applyNowButton = document.querySelector('.sendable_section--fixed');
                dom.toggleClass(applyNowButton, 'sendable_section--fixed', 'sendable_section');
                if (event.type === 'scroll') {
                    position = window.scrollY + (applyNowButton.clientHeight * 2);
                    singleOffer.scrollTo(position);
                }
            }
        } else {
            if (document.querySelector('.sendable_section')) {
                let applyNowButton = document.querySelector('.sendable_section');
                dom.toggleClass(applyNowButton, 'sendable_section', 'sendable_section--fixed');
            }
        }
    },
    scrollTo: (position) => {
        $("html").animate({
            'scrollTop': position,
        }, 500, 'swing');
    },
    theViewportPassedOverHere: (y) => {
        console.log(y + ' ' + window.pageYOffset + ' ' + window.innerHeight);
        return window.pageYOffset + window.innerHeight >= y;
    }
};

if (document.querySelector('#job-description') !== null) {
    singleOffer.init();
}