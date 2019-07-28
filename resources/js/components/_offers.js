// Component Events
if (document.querySelector('.dropdown-button')) {
    document.querySelector('.dropdown-button').addEventListener('click', displayForm);
}

// Component Methods
function displayForm(event) {
    event.preventDefault();
    var formIsDisplayed = $('.items_form').length;

    if (!formIsDisplayed) {
        $('.items_form--hidden').addClass('items_form')
                               .removeClass('items_form--hidden');

        let previousElementPosition = document.querySelector('.offers').offsetTop + document.querySelector('.offers').clientHeight;
        scrollTo(previousElementPosition);
    }

    if (formIsDisplayed) {
        $('.items_form').addClass('items_form--hidden')
                       .removeClass('items_form');
    }
}

function scrollTo(target) {
    $("html, body").animate({
        'scrollTop': target
    }, 1000, 'swing');
}