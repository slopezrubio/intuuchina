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

    this.getParentItem = function(element) {
        return $(element).parents('.media-card__list-item')[0];
    };

    this.getCardTitle = function(item) {
        if (item !== null) {
            return item.querySelector('.media-card__heading');
        }

        return null;
    };
}

export var mediaCardFactory = new CardsFactory();

export default MediaCard;