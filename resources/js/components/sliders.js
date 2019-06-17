import dom from '/media/meinsusseichhornchen/DATOS/Salva/Proyectos/Apache/intuuchina/resources/js/main/dom';

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

        // Compatibility with all the browsers
        for (let i = 0; i < sliders.tvLinks.length; i++) {
            sliders.tvLinks[i].addEventListener('click', function(e) {
                e.preventDefault();
                let elementIndex = $(this).index();
                sliders.moveTo(elementIndex);
                sliders.noScroll();
            })
        }
    },
    update: function() {
        let value = `translateX(${sliders.tvSliderWidth * -sliders.currentSlide}px)`;
        dom.setProperty(sliders.carrousel, 'transform', value);
    },
    moveTo: function(elementIndex) {
        sliders.currentSlide = elementIndex + 1;
        let value = `translateX(${sliders.tvSliderWidth * -sliders.currentSlide}px)`;
        dom.setProperty(sliders.carrousel, 'transform', value);
    },
    getFirstChildWidth: function(element) {
        let indexFirstElement = 0;
        return element[indexFirstElement].offsetWidth;
    },
    setSize: (element, type, value) => {
        element.style[type] = `${value}px`;
    },
    noScroll: () => {
        window.scrollBy(0, 0);
    }
};

if (document.querySelector('.note_carrousel') !== null) {
    $(document).ready(sliders.init);
    $(window).resize(sliders.init);
}
