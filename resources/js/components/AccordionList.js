import { ListFactory } from "../factories/ListFactory";

import dom from "../facades/dom";

function AccordionList(options) {
    this.items = [];

    this.init = function() {
        this.items = this.el.getElementsByClassName('accordion-list__card');

        for (let i = 0; i < this.items.length; i++) {
            if (dom.isElement(this.items[i]) || dom.isNode(this.items[i])) {
                this.clampItem(this.items[i]);
            }
        }

        return this;
    };

    this.clampItem = function(item) {
        $clamp(this.getCardTitle(item), {clamp: 1});
        $clamp(this.getCardSubtitle(item), {clamp: 1});
        $clamp(this.getCardDescription(item), {clamp: 2});
    };

    this.getCardTitle = function(item) {
        if (item !== null) {
            return item.querySelector('.accordion-list__card-title');
        }

        return null;
    };

    this.getCardSubtitle = function(item) {
        if (item !== null) {
            return item.querySelector('.accordion-list__card-subtitle');
        }

        return null;
    }

    this.getCardDescription = function(item) {
        if (item !== null) {
            return item.querySelector('.accordion-list__card-description');
        }

        return null;
    }

    this.getParentCard = function(element) {
        return $(element).parents('.accordion-list__card')[0];
    }
}

export var accordionListFactory = new ListFactory();

export default AccordionList;