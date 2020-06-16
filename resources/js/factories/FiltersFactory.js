import IndustryFilter from '../components/filters/IndustryFilter';
import Searchbox from '../components/filters/Searchbox';
import UserStatusFilter from "../components/filters/UserStatusFilter";

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
        case 'user-status':
            this.filterClass = UserStatusFilter;
    };

    return new this.filterClass(options);
};