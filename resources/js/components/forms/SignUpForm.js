import { FormFactory } from "../../factories/FormsFactory";
import dom from "../../facades/dom";

function SignUpForm(options) {
    this.fields = {
        name: document.getElementById('register-name'),
        surnames: document.getElementById('surnames'),
        email: document.getElementById('register-email'),
        phone_number: {
            prefix: document.getElementById('prefix'),
            number: document.getElementById('phone-number')
        },
        program: document.getElementById('program'),
        cv: document.getElementById('cv'),
    };

    this.fieldsets = {
        industry: document.getElementById('industryFieldset'),
        study: document.getElementById('studyFieldset'),
        university: document.getElementById('universityFieldset'),
    };

    this.init = function() {
        this.fields.program.addEventListener('change', () => {
            this.updateFieldset(this);
        }, this)
    };

    this.init();
}

export var signUpFormFactory = new FormFactory();

export default SignUpForm;