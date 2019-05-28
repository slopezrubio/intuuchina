// Component Events
if (document.querySelector('.dropdown-button')) {
    document.querySelector('.dropdown-button').addEventListener('click', displayForm);
}

// Component Methods
function displayForm(event) {
    event.preventDefault();
    var formIsDisplayed = $('.form_body').length;

    if (!formIsDisplayed) {
        $('.form_body--hidden').addClass('form_body')
                               .removeClass('form_body--hidden');

        var positionForm = $('.form_body').position();
        scrollTo($('.form_body'));
    }

    if (formIsDisplayed) {
        $('.form_body').addClass('form_body--hidden')
                       .removeClass('form_body');
    }
}

function scrollTo(target) {
    console.log(target);
    var $target = $(target);
    $("html, body").animate({
        'scrollTop': target.offset().top
    }, 1000, 'swing');
}