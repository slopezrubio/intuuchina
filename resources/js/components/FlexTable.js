import { TableFactory } from "../factories/TableFactory";

import str from '../facades/str';

function FlexTable(options) {

    this.headers = null;

    this.init = function() {
        this.headers = $(this.el).find('thead > tr > th');

        for (let i = 0; i < this.headers.length; i++) {
            let column = str.camelCase(this.headers[i].getAttribute('data-value'))

            this['row' + column.charAt(0).toUpperCase() + column.substr(1)] = (element) => {
                return $(this.row(element)).children('td[data-label=' + str.titleCase(column) + ']')[0];
            };
        }

        return this;
    }

    this.row = function(element) {
        return $(element).parents('.flex-table__item-content')[0];
    }
}

export var flexTableFactory = new TableFactory();

export default FlexTable;