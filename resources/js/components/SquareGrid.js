import { GridFactory } from "../factories/GridsFactory";
import browser from "../facades/browser";

function SquareGrid(options) {
    this.items = [];

    this.highest = null;

    this.init = function() {
        this.items = this.el.getElementsByClassName('square-grid__square');

        for (let i = 0; i < this.items.length; i++) {
            if (this.highest == null) {
                this.highest = this.items[i];
            }

            this.highest = this.items[i].clientHeight > this.highest.clientHeight
                                ? this.items[i] : this.highest;
        }

        this.levelItems();

        window.addEventListener('resize', (ev) => {
            this.levelItems();
        })
    }

    this.levelItems = function(unit = 'px') {

            for (let i = 0; i < this.items.length; i++) {
                if (!this.highest.isEqualNode(this.items[i])) {
                    this.items[i].style.height = browser.isBootstrapBreakpoint('sm') ?
                                                    this.highest.clientHeight + unit : '';
                }

        }
    }
}

export var squareGridFactory = new GridFactory();

export default SquareGrid;