import DOM from '../main/dom';
import MediaQueries from "../main/breakpoints";
import ArrowSlider from './ArrowSlider';
import api from '../main/api.js';

let press = {
    currentSlide: 0,
    carrousel: document.querySelector('.note_carrousel'),
    pictureHolder: document.querySelector('.note_window'),
    pictures: document.getElementsByClassName('slider_note'),
    tvSliderWidth: 0,
    tvLinks: document.querySelector('.tv') !== null ? document.querySelector('.tv').getElementsByTagName('a') : null,
    init: (event) => {
        if (event.type !== 'resize') {
            press.setup();
        }

        press.carrousel.style.width = $(press.pictureHolder).width() * press.pictures.length + 'px';
        $(press.pictures).width(press.pictureHolder.clientWidth);
        press.tvSliderWidth = press.getFirstChildWidth(press.pictures);

        if (event.type === 'resize') {
            press.update();
        }

        press.setSize(press.pictureHolder, 'height', press.pictures[0].offsetHeight);
    },
    setup: function() {
        press.tvSliderWidth = press.getFirstChildWidth(press.pictures);

        // Compatibility with all the browsers
        for (let i = 0; i < press.tvLinks.length; i++) {
            press.tvLinks[i].addEventListener('click', function(e) {
                e.preventDefault();
                let elementIndex = $(this).index();
                press.moveTo(elementIndex);
                press.noScroll();
            })
        }
    },
    update: function() {
        let value = `translateX(${press.tvSliderWidth * -press.currentSlide}px)`;
        DOM.setProperty(press.carrousel, 'transform', value);
    },
    moveTo: function(elementIndex) {
        press.currentSlide = elementIndex + 1;
        let value = `translateX(${press.tvSliderWidth * -press.currentSlide}px)`;
        DOM.setProperty(press.carrousel, 'transform', value);
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

var coursesSlider = (function() {
    var arrowSlider = null;

    function replaceCourseInfoSection(newCourseInfoSection) {
        $('.course-information').remove();
        $('section.arrow-slider').after(newCourseInfoSection);
    }

    function getCurrentSlide() {
        let controllers = document.querySelector('.arrow-slider__controllers').children;

        for (let i = 0; i < controllers.length; i++) {
            if ($(controllers[i]).hasClass('selected')) {
                return i;
            }
        }
    }

    return {
        init: function() {
            arrowSlider = new ArrowSlider({
                holder: document.querySelector('.arrow-slider__holder'),
                slide: getCurrentSlide(),
                colors: [
                    'black',
                    '\#C80B0B'
                ],
                controllers: document.querySelector('.arrow-slider__controllers').children,
                controllersCallback: function (slider) {
                    let course = slider.querySelector('#study').getAttribute('value');
                    let courseInfoSection = api.getCourseInfo(course, replaceCourseInfoSection);
                }
            });
        }
    }
})();

let universitySlider = {
    init: function() {
        var arrowSlider = new ArrowSlider({
            holder: document.querySelector('.arrow-slider__holder'),
            colors: [
                'white',
                'black',
                '\#E57373'
            ],
            controllers: document.querySelector('.arrow-slider__controllers').children,
        });
    }
}

if (document.querySelector('.note_carrousel') !== null) {
    $(document).ready(press.init);
    $(window).resize(press.init);
}

if (document.querySelector('header#learn-chinese') !== null) {
    window.addEventListener('load', coursesSlider.init);
}

if (document.querySelector('header#university') !== null) {
    window.addEventListener('load', universitySlider.init);
}