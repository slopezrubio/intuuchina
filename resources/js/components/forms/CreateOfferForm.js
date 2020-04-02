import { FormFactory } from "../../factories/FormsFactory";

function CreateOfferForm() {
    this.fields = {};

    this.init = function() {
        this.fields.title = this.el.querySelector('#title');
        this.fields.location = this.el.querySelector('#location');
        this.fields.industry = this.el.querySelector('#industry');
        this.fields.description = this.el.querySelector('#description');
        this.editor = this.el.querySelector('#description-editor');
        this.previewUploadedFiles();
        this.editor = this.mountWYSIWYGEditor();

        this.el.addEventListener('submit', (ev) => {
            this.fields.description.value = JSON.stringify(this.editor.getContents());
        });

        return this;
    };
}

export var createOfferFormFactory = new FormFactory();

export default CreateOfferForm;