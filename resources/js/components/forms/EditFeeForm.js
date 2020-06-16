import { FormFactory } from '../../factories/FormsFactory';
import EditOfferForm from "./EditOfferForm";

import dom from '../../facades/dom';

function EditFeeForm(options) {
    this.fields = {};

    this.init = function() {
        this.fields.name = this.el.querySelector('#name');
        this.fields.unit = this.el.querySelector('#unit');
        this.fields.heading = this.el.querySelector('#unit');
        this.fields.amount = this.el.querySelector('#amount');
        this.fields.minimum = this.el.querySelector('#minimum');
        this.fields.tax = this.el.querySelector('#tax');

        this.setInputFilter(this.fields.amount, (value) => {
            return this.filters.float.test(value);
        });

        this.setInputFilter(this.fields.minimum, (value) => {
            return this.filters.integer.test(value);
        });
    }
}

export var editFeeFormFactory = new FormFactory();

export default EditFeeForm;