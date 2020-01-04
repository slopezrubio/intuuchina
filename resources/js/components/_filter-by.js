let filterBy = {
    init: () => {
        addEventListener('resize', filterBy.upload);
    },
    selector: document.querySelector('.custom-select-wrapper'),
    arrowBackgroundWidth: 62,
    upload: () => {
        filterBy.moveArrow();
    },
    moveArrow: () => {
        let property = 'background-image';
        let value = 'linear-gradient(to right, black ' + (filterBy.selector.clientWidth - filterBy.arrowBackgroundWidth) + 'px, #B71C1C 70px)';
        $(filterBy.selector).css(property, value);
    }
};

if (document.querySelector('.custom-select-wrapper') !== null) {
    filterBy.init();
}