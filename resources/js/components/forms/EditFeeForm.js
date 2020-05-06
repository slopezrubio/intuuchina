import { FormFactory } from '../../factories/FormsFactory';
import EditOfferForm from "./EditOfferForm";

import dom from '../../facades/dom';

function EditFeeForm(options) {
    this.fields = {};

    this.init = function() {
        this.fields.name = this.el.querySelector('#name');
        this.fields.fee_type = this.el.querySelector('#fee_type');
        this.fields.unit = this.el.querySelector('#unit');
        this.fields.amount = this.el.querySelector('#amount');
        this.fields.minimum = this.el.querySelector('#minimum');
        this.fields.tax = this.el.querySelector('#tax');

        this.updateFields();


        this.setInputFilter(this.fields.amount, (value) => {
            return this.filters.float.test(value);
        });

        this.setInputFilter(this.fields.minimum, (value) => {
            return this.filters.integer.test(value);
        });

        this.fields.fee_type.addEventListener('change', (ev) => {
            this.updateFields()
        })
    }

    this.updateFields = function() {
        if (this.fields.fee_type.value === 'unit_rate') {
            dom.show($(this.fields.unit).parents('.form-group')[0]);
            return this;
        }

        dom.hide($(this.fields.unit).parents('.form-group')[0]);
    }
}

export var editFeeFormFactory = new FormFactory();

export default EditFeeForm;