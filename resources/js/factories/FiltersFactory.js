import IndustryFilter from '../components/filters/IndustryFilter';
import Searchbox from '../components/filters/Searchbox';

export function FilterFactory() {}

FilterFactory.prototype.filterClass = null;

FilterFactory.prototype.createFilter = function(options) {
    switch(options.type) {
        case 'industry':
            this.filterClass = IndustryFilter;
            break;
        case 'search':
            this.filterClass = Searchbox;
            break;
    };

    return new this.filterClass(options);
};