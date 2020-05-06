import { ListFactory } from "../factories/ListFactory";

import dom from "../facades/dom";

function AccordionList(options) {
    this.items = [];

    this.init = function() {
        this.items = this.el.getElementsByClassName('accordion-list__card');

        this.clampCardHeader();

        return this;
    };

    this.clampCardHeader = function() {
        for (let i = 0; i < this.items.length; i++) {
            if (dom.isElement(this.items[i]) || dom.isNode(this.items[i])) {
                $clamp(this.getCardTitle(this.items[i]), {clamp: 1});
                $clamp(this.getCardSubtitle(this.items[i]), {clamp: 1});
                $clamp(this.getCardDescription(this.items[i]), {clamp: 2});
            }
        }
    };

    this.getCardTitle = function(element) {
        if (element !== null) {
            return element.querySelector('.accordion-list__card-title');
        }

        return null;
    };

    this.getCardSubtitle = function(element) {
        if (element !== null) {
            return element.querySelector('.accordion-list__card-subtitle');
        }

        return null;
    }

    this.getCardDescription = function(element) {
        if (element !== null) {
            return element.querySelector('.accordion-list__card-description');
        }

        return null;
    }
}

export var accordionListFactory = new ListFactory();

export default AccordionList;