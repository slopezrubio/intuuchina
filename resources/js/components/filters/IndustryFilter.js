import { FilterFactory } from "../../factories/FiltersFactory";
import api from "../../facades/api";

function IndustryFilter(options) {
    this.el = options.filter;
    this.callback = options.callback;

    this.init = function() {
        this.el.addEventListener('change', (ev) => {
            this.applyFilter(this.callback, ev.target.value);
        });
    };

    this.applyFilter = function(callback, filter) {
        api.jQueryGet(api.getRoute('offers'),null, [filter], function(data) {
            callback(data);
        });
    };

    this.init();
}

export var industryFilterFactory = new FilterFactory();

export default IndustryFilter;