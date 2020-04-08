import { CardsFactory } from '../factories/CardsFactory';

function MediaCard(options) {
    this.items = [];

    this.init = function() {
        this.items = this.el.getElementsByClassName('media-card__card');

        return this;
    };

    this.getCard = function(key) {
        return this.items[key];
    };

    this.getCardTitle = function(key) {
        if (this.getCard(key) !== null) {
            return this.getCard(key).querySelector('.media-card__heading').innerText;
        }

        return null;
    };
}

export var mediaCardFactory = new CardsFactory();

export default MediaCard;