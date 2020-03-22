import { FilterFactory } from "../../factories/FiltersFactory";
import api from "../../facades/api";
import IndustryFilter from "./IndustryFilter";

function Searchbox(options) {
    this.el = options.filter;
    this.callback = options.callback;

    this.init = function() {

    }
}

export var searchboxFactory = new FilterFactory();

export default Searchbox;