import { FilterFactory } from "../../factories/FiltersFactory";
import api from "../../facades/api";

function IndustryFilter(options) {
    this.el = options.filter;
    this.callback = options.callback;

    this.init = function() {
        this.el.addEventListener('change', () => {
            this.applyFilter(this.callback);
        });
    };

    this.getSelectedValue = function() {
        return this.el.value;
    };

    this.applyFilter = function(callback) {
        api.jQueryGet(api.getRoute('offers'), null, [this.getSelectedValue()], function(data) {
            callback(data);
        });
    };

    this.getSelectedIndex = function() {
        return this.el.selectedIndex;
    };

    this.init();
}

export var industryFilterFactory = new FilterFactory();

export default IndustryFilter;