import FlexTable from '../components/FlexTable.js';

export function TableFactory() {}

TableFactory.prototype.tableClass = null;

TableFactory.prototype.createTable = function(options) {

    switch(options.type) {
        case 'flex':
            this.tableClass = FlexTable;
            break;
    }

    let tableClass = new this.tableClass(options);

    tableClass.el = options.el !== null ? options.el : null ;

    tableClass.form = options.form !== null ? options.form : null;

    return tableClass;
};