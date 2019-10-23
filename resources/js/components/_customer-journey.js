import breakpoints from "../main/breakpoints";
import dom from "../main/dom.js";
import env from '../main/env'

let customerJourney = {
    init: function() {
        if (document.querySelector('.customer-journey')) {
            window.addEventListener('load', customerJourney.setup);
            window.addEventListener('resize', customerJourney.setup);
        }
    },
    element: document.querySelector('.customer-journey') !== undefined ? document.querySelector('.customer-journey') : undefined,
    setup: function(event) {
        customerJourney.setPicture[event.type]();
    },
    setPicture: {
        'load': function() {
            let picture = customerJourney.element.querySelector('img');

            if (breakpoints.isCustomerJourney()) {
                let src = env.paths.public + 'storage/images/infography_' + customerJourney.getLocale() + '_vertical.png';
                picture.setAttribute('src', src);
                dom.toggleClass(customerJourney.element, 'customer-journey--mobile', 'customer-journey');
                return true;
            }

            let src = env.paths.public + 'storage/images/infography_' + customerJourney.getLocale() + '_horizontal.png';
            picture.setAttribute('src', src);
            return true;
        },
        'resize': function() {
            let picture = customerJourney.element.querySelector('img');
            let classPattern = /customer-journey--mobile(\s+|$)/;

            if (breakpoints.isCustomerJourney() && customerJourney.element.getAttribute('class').match(classPattern) === null) {
                let src = env.paths.public + 'storage/images/infography_' + customerJourney.getLocale() + '_vertical.png';
                picture.setAttribute('src', src);
                dom.toggleClass(customerJourney.element, 'customer-journey--mobile', 'customer-journey');

                return true;
            }

            if (!breakpoints.isCustomerJourney() && customerJourney.element.getAttribute('class').match(classPattern)) {
                console.log("matches");
                let src = env.paths.public + 'storage/images/infography_' + customerJourney.getLocale() + '_horizontal.png';
                picture.setAttribute('src', src);
                dom.toggleClass(customerJourney.element, 'customer-journey--mobile', 'customer-journey');

                return true;
            }

            return false;
        }
    },
    getLocale: function() {
        return document.querySelector('html').getAttribute('lang');
    }

};


customerJourney.init();
