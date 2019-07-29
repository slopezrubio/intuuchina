let offers = {
    init: () => {
        window.addEventListener('load', function(event) {
            offers.setup(event);
        })
    },
    setup: (event) => {
        if (document.querySelector('.items_form') !== null || document.querySelector('.items_form--hidden')) {
            console.log("hola");
            var editor = new Quill('.editor', {
                modules: {
                    toolbar: [
                        [{ header: [1, 2, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }, 'blockquote'],
                        [{ 'indent' : '-1'}, { 'indent' : '+1'}, 'link', 'code-block']
                    ]
                },
                placeholder: 'Compose an epic...',
                theme: 'snow'
            });
        }
    }
}

// Component Events
if (document.querySelector('.dropdown-button')) {
    //document.querySelector('.dropdown-button')..addEventListener('click', displayForm);
    let dropdownButtons = document.querySelectorAll('.dropdown-button');
    for (let i = 0; i < dropdownButtons.length; i++) {
        dropdownButtons[i].addEventListener('click', displayForm);
    }
}

// Component Methods
function displayForm(event) {
    event.preventDefault();
    var formIsDisplayed = $('.items_form').length;

    if (!formIsDisplayed) {
        $('.items_form--hidden').addClass('items_form')
                               .removeClass('items_form--hidden');

        /*
         * Save the Y axis of the bottom of the previous element placed just
         * above the form that is going to be displayed.
         */
        let previousElementPosition = document.querySelector('.offers').offsetTop + document.querySelector('.offers').clientHeight;

        // Scrolls the page where the form is being displayed.
        scrollTo(previousElementPosition);

        // Heads the typing to the first field of the hidden form
        let firstInputOfTheForm = $('.form_body input').filter(':first');
        firstInputOfTheForm.focus();
    }

    if (formIsDisplayed) {
        let itemManagementPosition = document.querySelector('.items_management').offsetTop;
        scrollTo(itemManagementPosition);
        setTimeout(function() {
            $('.items_form').addClass('items_form--hidden')
                .removeClass('items_form')
        }, 500);
    }
}

function scrollTo(target) {
    $("html, body").animate({
        'scrollTop': target
    }, 1000, 'swing');
}

if (document.querySelector('.offers') !== null) {
    offers.init();
}