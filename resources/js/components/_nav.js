// Component Events
if (document.querySelector('.toggleMenu') !== null) {
    document.querySelector('.toggleMenu').addEventListener('click', displayNav);
}


// Component Methods
function displayNav(event) {
    $('.navbar_menu--hidden').toggleClass('navbar_menu--display');
}