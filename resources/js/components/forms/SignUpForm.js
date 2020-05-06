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

    // this.getSelectedProgram = function() {
    //     return this.fields.program.options[this.fields.program.selectedIndex].value;
    // };
    //
    // this.updateFieldset = function(self = this) {
    //     switch (self.getSelectedProgram()) {
    //         case 'internship':
    //         case 'inter_relocat':
    //             dom.show(self.fields.cv.parentElement.parentElement, 'flex');
    //             dom.show(self.fieldsets.industry, 'flex');
    //             dom.hide(self.fieldsets.university);
    //             dom.hide(self.fieldsets.study);
    //             break;
    //         case 'study':
    //             dom.show(self.fieldsets.study, 'flex');
    //             dom.hide(self.fields.cv.parentElement.parentElement);
    //             dom.hide(self.fieldsets.industry);
    //             dom.hide(self.fieldsets.university);
    //             break;
    //         case 'university':
    //             dom.show(self.fieldsets.university, 'flex');
    //             dom.show(self.fields.cv.parentElement.parentElement, 'flex');
    //             dom.hide(self.fieldsets.study);
    //             dom.hide(self.fieldsets.industry);
    //             break;
    //     }
    // }

    this.init();
}

export var signUpFormFactory = new FormFactory();

export default SignUpForm;