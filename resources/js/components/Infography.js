import { InfographyFactory } from "../factories/InfographyFactory";
import browser from '../facades/browser';

function Infography(options) {
    this.items = [];

    this.init = function() {
        this.items = this.el.getElementsByClassName('step-list__item');

        window.addEventListener('load', (ev) => {
            this.showItems(ev)
        });

        window.addEventListener('scroll', (ev) => {
            this.showItems(ev)
        });

        window.addEventListener('resize', (ev) => {
            this.showItems(ev)
        });
    }

    this.showItems = function(ev) {
        for (let i = 0; i < this.items.length; i++) {
            if (!$(this.items[i]).hasClass('show') && browser.isElementScoped(this.items[i])) {
                $(this.items[i]).addClass('show');
            }
        };
    }
}

export var infographyFactory = new InfographyFactory();

export default Infography;