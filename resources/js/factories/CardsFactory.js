import MediaCards from '../components/MediaCards';

export function CardsFactory() {}

CardsFactory.prototype.cardClass = null;

CardsFactory.prototype.createCard = function(options) {
    switch(options.type) {
        case 'media':
            this.cardClass = MediaCards;
            break;
    };

    let cardClass = new this.cardClass(options);

    cardClass.el = options.el;

    cardClass.form = options.form !== null ? options.form : null;

    return cardClass;
};