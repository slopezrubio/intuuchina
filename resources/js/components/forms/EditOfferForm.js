import { FormFactory } from '../../factories/FormsFactory';
import api from "../../facades/api";

function EditOfferForm(options) {
    this.fields = {};

    this.editor = null;

    this.init = async function() {
        this.fields.id = this.el.querySelector('#id');
        this.fields.title = this.el.querySelector('#title');
        this.fields.location = this.el.querySelector('#location');
        this.fields.industry = this.el.querySelector('#industry');
        this.fields.description = this.el.querySelector('#description');
        this.editor = this.el.querySelector('#description-editor');

        this.offer = await api.axiosRequest(api.getResource('offers', this.fields.id.value), 'get');

        this.previewUploadedFiles()
            .loadDescription();

        this.el.addEventListener('submit', (ev) => {
            ev.preventDefault()
            this.fields.description.value = JSON.stringify(this.editor.getContents());
            this.el.submit();
        })
    };

    this.loadDescription = function() {
        let description = this.editor.getAttribute('data-html');

        this.editor = this.mountWYSIWYGEditor();

        if (this.offer.data.description !== null) {
            this.editor.setContents(JSON.parse(this.offer.data.description));
        }

        return this
    };
}

export var editOfferFormFactory = new FormFactory();

export default EditOfferForm;