import { FormFactory } from '../../factories/FormsFactory';

function EditOfferForm(options) {
    this.fields = {};

    this.editor = null;

    this.init = function() {
        this.fields.title = this.el.querySelector('#title');
        this.fields.location = this.el.querySelector('#location');
        this.fields.industry = this.el.querySelector('#industry');
        this.fields.description = this.el.querySelector('#description');
        this.editor = this.el.querySelector('#description-editor');
        this.previewUploadedFiles()
            .loadDescription();

        this.el.addEventListener('submit', (ev) => {
            this.fields.description.value = JSON.stringify(this.editor.getContents());
        })
    };

    this.loadDescription = function() {
        let description = this.editor.getAttribute('data-html');

        this.editor = this.mountWYSIWYGEditor();
        this.editor.setContents(JSON.parse(description));

        return this
    };
}

export var editOfferFormFactory = new FormFactory();

export default EditOfferForm;