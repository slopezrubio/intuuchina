import MediaQueries from "../main/breakpoints";
import DOM from "../main/dom";
import UI from '../main/UI';

var customerJourney = {
    init: function() {
        if (document.querySelector('.customer-journey')) {
            window.addEventListener('load', (e) => {
                this.setPictures();
            });
            window.addEventListener('resize', (e) => {
                this.setPictures();
            });
        }
    },
    el: document.querySelector('.customer-journey') !== undefined ? document.querySelector('.customer-journey') : null,
    currentPicture: null,
    pictures: {
        horizontal: null,
        vertical: null
    },
    setPictures: function() {
        this.currentPicture = this.el.querySelector('img');

        if (this.pictures.horizontal === null) {
            this.pictures.horizontal = this.currentPicture.getAttribute('src').match(UI.getPattern('horizontalCustomerJourney'))
                ? this.currentPicture.getAttribute('src')
                : this.currentPicture.getAttribute('src').replace(/vertical/, 'horizontal');
        }

        if (this.pictures.vertical === null) {
            this.pictures.vertical = this.currentPicture.getAttribute('src').match(UI.getPattern('verticalCustomerJourney'))
                ? this.currentPicture.getAttribute('src')
                : this.currentPicture.getAttribute('src').replace(/horizontal/, 'vertical')
        }

        this.loadPicture();
    },
    loadPicture: function() {
        let newCustomerJourneyPicture = UI.getCustomerJourneyPicture(this.el);

        if (newCustomerJourneyPicture !== null) {
            DOM.toggleSingleClass(this.el, newCustomerJourneyPicture.className);
            this.currentPicture.setAttribute('src', this.pictures[newCustomerJourneyPicture.src]);
        };
    }
};


customerJourney.init();
