 let sliders = {
    currentSlide: 0,
    carrousel: document.querySelector('.note_carrousel'),
    pictureHolder: document.querySelector('.note_window'),
    pictures: document.getElementsByClassName('slider_note'),
    tvSliderWidth: 0,
    tvLinks: document.querySelector('.tv') !== null ? document.querySelector('.tv').getElementsByTagName('a') : null,
    init: (event) => {
        if (event.type !== 'resize') {
            sliders.setup();
        }

        $(sliders.pictures).width(sliders.pictureHolder.clientWidth);
        sliders.tvSliderWidth = sliders.getFirstChildWidth(sliders.pictures);

        if (event.type === 'resize') {
            sliders.update();
        }

        sliders.setSize(sliders.pictureHolder, 'height', sliders.pictures[0].offsetHeight);
    },
    setup: function() {
        sliders.tvSliderWidth = sliders.getFirstChildWidth(sliders.pictures);
        for (element of sliders.tvLinks) {
            element.addEventListener('click', function() {
                let elementIndex = $(this).index();
                sliders.moveTo(elementIndex);
            })
        }
    },
    update: function() {
        let value = `translateX(${sliders.tvSliderWidth * -sliders.currentSlide}px)`;
        sliders.setProperty(sliders.carrousel, 'transform', value);
    },
    moveTo: function(elementIndex) {
        sliders.currentSlide = elementIndex + 1;
        let value = `translateX(${sliders.tvSliderWidth * -sliders.currentSlide}px)`;
        sliders.setProperty(sliders.carrousel, 'transform', value);
    },
    getFirstChildWidth: function(element) {
        let indexFirstElement = 0;
        return element[indexFirstElement].offsetWidth;
    },
    setProperty: function(element, property, value) {
        element.style[property] = value;
    },
    getProperty: function(element, property) {
        return element.style.getPropertyValue(property);
    },
    setSize: (element, type, value) => {
        element.style[type] = `${value}px`;
    }
};

if (document.querySelector('.note_carrousel') !== null) {
    $(document).ready(sliders.init);
    $(window).resize(sliders.init);
}
