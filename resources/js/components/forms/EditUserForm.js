import { FormFactory } from "../../factories/FormsFactory";


function EditUserForm() {
    this.fields = {};

    this.fieldsets = {
        industry: document.getElementById('industryFieldset'),
        study: document.getElementById('studyFieldset'),
        university: document.getElementById('universityFieldset'),
    };

    this.init = function() {
        this.fields = {
            name: this.el.querySelector('#name'),
            surnames: this.el.querySelector('#surnames'),
            email: this.el.querySelector('#email'),
            phone_number: {
                prefix: document.getElementById('prefix'),
                number: document.getElementById('phone-number')
            },
            program: document.getElementById('program'),
            cv: document.getElementById('cv'),
        };

        this.fields.program.addEventListener('change', () => {
            this.updateFieldset(this);
        }, this)
    };
}

export var editUserFormFactory = new FormFactory();

export default EditUserForm;