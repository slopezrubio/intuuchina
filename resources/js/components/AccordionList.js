import { ListFactory } from "../factories/ListFactory";

function AccordionList(options) {
    this.items = [];

    this.init = function() {
        this.items = this.el.getElementsByClassName('accordion-list__card');

        return this;
    }

    this.getCard = function(key) {
        return this.items[key];
    };

    this.getCardTitle = function(key) {
        if (this.getCard(key) !== null) {
            return this.getCard(key).querySelector('.accordion-list__card-title').innerText;
        }

        return null;
    };
}

export var accordionListFactory = new ListFactory();

export default AccordionList;