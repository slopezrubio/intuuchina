import AccordionList from '../components/AccordionList';

export function ListFactory() {}

ListFactory.prototype.listClass = null;

ListFactory.prototype.createList = function(options) {
    switch(options.type) {
        case 'accordion':
            this.listClass = AccordionList;
            break;
    }

    let listClass = new this.listClass(options);

    listClass.el = options.el;

    listClass.form = options.form !== null ? options.form : null;

    return listClass;
};