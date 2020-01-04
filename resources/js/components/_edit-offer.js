let editOffer = {
    init: () => {
        editOffer.setup();
    },
    form: document.querySelector('#editOffer') !== null ? document.querySelector('#editOffer') : null,
    setup: () => {
        window.addEventListener('load', function(event) {
            editOffer.loadWYSIWYGEditor();
        });

        editOffer.inputPicture.addEventListener('change', function(event) {
            editOffer.picturePreview(this, $(this).siblings('.img-preview'));
        })
    },
    inputPicture: document.getElementById('picture') !== null ? document.getElementById('picture') : null,
    loadWYSIWYGEditor: function() {
        if (document.querySelector('.items_form') !== null || document.querySelector('.items_form--hidden')) {
            var editor = new Quill('.editor', {
                modules: {
                    toolbar: [
                        [{ header: [4, 5, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered' }, {'list': 'bullet'}, 'blockquote'],
                        [{ 'indent' : '-1'}, { 'indent' : '+1'}, 'link', 'code-block']
                    ]
                },
                placeholder: 'Write down the job description...',
                theme: 'snow'
            })
        }

        let delta = document.querySelector('.editor').getAttribute('data-html');
        editOffer.setDeltaToEditor(delta, editor);

        editOffer.form.addEventListener('submit', function() {
            let description = document.querySelector('input[name=description]');
            description.value = JSON.stringify(editor.getContents());
        });
    },
    setDeltaToEditor(delta, editor) {
        editor.setContents(JSON.parse(delta));
    },
    picturePreview: function(input, imgElement) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.addEventListener('load', function(e) {
               $(imgElement).attr('src', e.target.result);
           });

           reader.readAsDataURL(input.files[0])
       }
    }

}

if (document.querySelector('#editOffer') !== null) {
    editOffer.init();
}