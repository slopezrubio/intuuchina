import dom from '../main/dom';
import breakpoints from "../main/breakpoints";

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
        dom.setProperty(press.carrousel, 'transform', value);
    },
    moveTo: function(elementIndex) {
        press.currentSlide = elementIndex + 1;
        let value = `translateX(${press.tvSliderWidth * -press.currentSlide}px)`;
        dom.setProperty(press.carrousel, 'transform', value);
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

let courses = {
    currentSlide: 0,
    carrousel: document.querySelector('.description-container'),
    pictureHolder: document.querySelector('.course-descriptions'),
    pictures: document.getElementsByClassName('description-base'),
    courseLinks: document.querySelector('.description-options') !== null ? document.querySelector('.description-options').getElementsByTagName('a') : null,
    init: (event) => {
        if (event.type !== 'resize') {
            courses.setup();
        }

        if (breakpoints.widths.largeDevices[0] > window.innerWidth) {
            $(courses.pictures).width(courses.pictureHolder.clientWidth);
        }

        courses.courseSliderWidth = courses.getFirstChildWidth(courses.pictures);

        if (event.type === 'resize') {
            //courses.update();
            //document.querySelector('.description-options').clientWidth;
        }

    },
    setup: function() {
        courses.courseSliderWidth = courses.getFirstChildWidth(courses.pictures);

        if (!breakpoints.isLargeDevice()) {
            // Compatibility with all the browsers
            for (let i = 0; i < courses.courseLinks.length; i++) {
                courses.courseLinks[i].addEventListener('click', function(e) {
                    e.preventDefault();
                    let elementIndex = $(this).index();
                    courses.moveTo(elementIndex);
                    courses.toggleControllers(document.querySelector('.selected'), courses.courseLinks[elementIndex]);
                    courses.changeSliderBackground[elementIndex](courses.carrousel);
                })
            }
        } else {
            for (let i = 0; i < courses.courseLinks.length; i++) {
                courses.resetSize(courses.pictures[i]);
            }

            courses.setDesktopSliders[courses.checkSelectedController()]();
        }
    },
    resetSize: (element) => {
        dom.setProperty(element, 'width', '');
    },
    setDesktopSliders: {
        first: () => {
            dom.toggleSingleClass(courses.pictures[courses.currentSlide], 'left-slide');
            dom.toggleSingleClass(courses.pictures[courses.currentSlide + 1], 'right-slide--none');
        },
        second: () => {
            dom.toggleSingleClass(courses.pictures[courses.currentSlide], 'left-slide--none');
            dom.toggleSingleClass(courses.pictures[courses.currentSlide + 1], 'right-slide');
        }
    },
    checkSelectedController: () => {
        return $('.selected').is(':last-child') ? 'second' : 'first';
    },
    toggleControllers: (firstController, secondController) => {
        dom.toggleSingleClass(firstController, 'selected');
        dom.toggleSingleClass(secondController, 'selected');
    },
    changeSliderBackground: [
        (element) => {
            dom.setProperty(element, 'background','#000000');
        },
        (element) => {
            dom.setProperty(element, 'background','#B71C1C');
        }
    ],
    setSize: (element, type, value) => {
        element.style[type] = `${value}px`;
    },
    courseSliderWidth: 0,
    getFirstChildWidth: function(element) {
        let indexFirstElement = 0;
        return element[indexFirstElement].offsetWidth;
    },
    moveTo: function(elementIndex) {
        courses.currentSlide = elementIndex;
        let value = `translateX(${courses.courseSliderWidth * -courses.currentSlide}px)`;
        dom.setProperty(courses.carrousel, 'transform', value);
    },
};

if (document.querySelector('.note_carrousel') !== null) {
    $(document).ready(press.init);
    $(window).resize(press.init);
}

if (document.querySelector('.course-descriptions') !== null) {
    $(document).ready(courses.init);
    $(window).resize(courses.init);
}