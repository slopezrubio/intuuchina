import { FilterFactory } from "../../factories/FiltersFactory";
import api from "../../facades/api";

function UserStatusFilter(options) {
    this.el = options.filter;
    this.callback = options.callback;

    this.init = function() {
        this.el.addEventListener('change', (ev) => {
            this.applyFilter(this.callback, ev.target.value);
        });
    };

    this.applyFilter = function(callback, filter) {
        let url = window.location.protocol + '//' + window.location.hostname + '/' + api.setParams('admin/users', { filter: filter });

        api.jQueryGet(url, null, null, function(data) {
            callback(data);
        });
    };

    this.init();
}

export var userStatusFilterFactory = new FilterFactory();

export default UserStatusFilter;