import DOM from '../main/dom';

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

        document.querySelector('#jobDescription').innerHTML = singleOffer.showDescription(document.querySelector('#jobDescription').getAttribute('data-html'));

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
                DOM.toggleClass(applyNowButton, 'sendable_section--fixed', 'sendable_section');
                if (event.type === 'scroll') {
                    position = window.scrollY + (applyNowButton.clientHeight * 2);
                    singleOffer.scrollTo(position);
                }
            }
        } else {
            if (document.querySelector('.sendable_section')) {
                let applyNowButton = document.querySelector('.sendable_section');
                DOM.toggleClass(applyNowButton, 'sendable_section', 'sendable_section--fixed');
            }
        }
    },
    scrollTo: (position) => {
        $("html").animate({
            'scrollTop': position,
        }, 500, 'swing');
    },
    showDescription: function(inputDelta) {
        inputDelta = JSON.parse(inputDelta);
        let tempCont = document.createElement("div");
        (new Quill(tempCont)).setContents(inputDelta);
        return tempCont.getElementsByClassName("ql-editor")[0].innerHTML;
    },
    theViewportPassedOverHere: (y) => {
        return window.pageYOffset + window.innerHeight >= y;
    }
};

if (document.querySelector('#job-description') !== null) {
    singleOffer.init();
}