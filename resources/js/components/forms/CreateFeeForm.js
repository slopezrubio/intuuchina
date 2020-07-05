import { FormFactory } from "../../factories/FormsFactory";

import api from '../../facades/api';
import dom from '../../facades/dom';
import object from '../../facades/object';

function CreateFeeForm() {
    this.fields = {};

    this.init = async function() {
        this.fields.name = this.el.querySelector('#name');
        this.fields.heading = this.el.querySelector('#heading');
        this.fields.fee_type = this.el.querySelector('#fee_type');
        this.fields.amount = this.el.querySelector('#amount');

        this.setFieldsets();

        this.setInputFilter(this.fields.amount, (value) => {
            return this.filters.float.test(value);
        });

        this.setInputFilter(this.fieldsets.minimum, (value) => {
            return this.filters.integer.test(value);
        });

        this.fields.fee_type.addEventListener('change', async (ev) => {
            this.toggleLoadingState();

            let programs = await api.axiosRequest(api.getRoute('hostname') + '/admin/programs', 'post', {
                fee_type: ev.target.value,
            });

            this.updateFeeFieldset(programs);

            this.toggleLoadingState();
        });
    };

    this.updateFeeFieldset = function(programs) {
        if (typeof this.fields.fee_type === 'undefined') {
            return null;
        };

        switch(this.fields.fee_type.value) {
            case 'unit_rate':
                dom.show(this.fieldsets.minimum);
                dom.show(this.fieldsets.unit);
                break;
            case 'entry_fee':
                dom.hide(this.fieldsets.minimum);
                dom.hide(this.fieldsets.unit);
                break;
        }

        programs = object.arrayValues(programs, 'value');

        programs.indexOf('internship') !== -1 || programs.indexOf('inter_relocat') !== -1 ?
            dom.show(this.fieldsets.industry) : dom.hide(this.fieldsets.industry);

        programs.indexOf('study') !== -1 ?
            dom.show(this.fieldsets.study) : dom.hide(this.fieldsets.study);

        programs.indexOf('university') !== -1 ?
            dom.show(this.fieldsets.university) : dom.hide(this.fieldsets.university);
    }

    this.setFieldsets = function() {
        this.fieldsets = {
            industry: document.getElementById('industryFieldset'),
            study: document.getElementById('studyFieldset'),
            university: document.getElementById('universityFieldset'),
            minimum: document.getElementById('minimumFieldset'),
            unit: document.getElementById('unitFieldset'),
        };
    }
}

export var createFeeFormFactory = new FormFactory();

export default CreateFeeForm;