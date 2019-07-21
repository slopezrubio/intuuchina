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
    defaultSelectedCourse: 1,
    pictureHolder: document.querySelector('.course-descriptions'),
    pictures: document.getElementsByClassName('description-base'),
    courseLinks: document.querySelector('.description-options') !== null ? document.querySelector('.description-options').getElementsByTagName('a') : null,
    requestedCourseURL: null,
    init: (event) => {
        courses.setup(event);

        if (breakpoints.widths.largeDevices[0] > window.innerWidth) {
            $(courses.pictures).width(courses.pictureHolder.clientWidth);
        }
    },
    setup: function(event) {
        courses.courseSliderWidth = courses.pictureHolder.clientWidth;

        // Events arranged to the slider controllers
        for (let i = 0; i < courses.courseLinks.length; i++) {
            courses.courseLinks[i].addEventListener('click', function(e) {
                e.preventDefault();
                if (courses.requestedCourseURL !== `/learn/course=${i + 1}`) {
                    courses.requestedCourseURL = `/learn/course=${i + 1}`;
                    courses.getCourseInfo(courses.requestedCourseURL);
                }

                let elementIndex = $(this).index();
                if (!breakpoints.isLargeDevice()) {
                    courses.moveTo(elementIndex);
                } else {
                    courses.setDesktopSliders[i + 1]();
                }

                if (!$(this).hasClass('selected')) {
                    courses.toggleControllers(elementIndex);
                    courses.changeSliderBackground[elementIndex](courses.carrousel);
                }
            });
        }

        // Events arranged to the clickable elements in the courses slider
        for (let i = 0; i < courses.pictures.length; i++) {
            courses.pictures[i].addEventListener('click', function(e) {
                e.preventDefault();

                /*
                 * Makes a GET request to the server ({ROOT_FOLDER}/learn/course=${course-number})
                 * to retrieve the fitting information for each course displayed
                 */
                if (courses.requestedCourseURL !== `/learn/course=${i + 1}`) {
                    courses.requestedCourseURL = `/learn/course=${i + 1}`;
                    courses.getCourseInfo(courses.requestedCourseURL);
                }

                let elementIndex = $(this).index();
                courses.setDesktopSliders[i + 1]();
                courses.toggleControllers(elementIndex);
                courses.changeSliderBackground[elementIndex](courses.carrousel);
            });
        }

        // Sets the courses slider UI according to the current device used
        if (!breakpoints.isLargeDevice()) {
            // Compatibility with all the browsers

            /*
             * Checks while resizing to watch or tail whether the UI needs to alter so that can fit
             * with the device used or simply keep the same.
             */
            if (event.type === 'resize') {
                courses.update();
                if (document.querySelector('.left-slide') !== null || document.querySelector('.right-slide') !== null) {
                    courses.resetDesktopSliders();
                }
            }
        } else {
            // Sets the course slider UI ready to be displayed in desktop devices
            courses.setDesktopSliders[courses.checkSelectedController()]();
            courses.resetResponsiveSliders();
        }
    },
    getCourseInfo: function(path, data = null) {
        $.get({
            url: path,
            cache: false,
            data: data,
            dataType: 'html',
            error: function(xhr, status, error) {
                console.log(error);
            },
            success: function(data, status, xhr) {
                $('.course-information').remove();
                $('.course-descriptions').after(data);
            }
        })
    },
    resetResponsiveSliders: () => {
        dom.setProperty(courses.carrousel, 'transform','translate(0px)');
    },
    keepSliderPositionWhenResponsive: () => {
        return courses.currentSlide === 0 ? 0 : courses.courseSliderWidth;
    },
    resetDesktopSliders: () => {
            for (let i = 0; i < courses.pictures.length; i++) {
                $(courses.pictures[i]).attr('class', 'description-base');
            }
    },
    setDesktopSliders: {
        1: () => {
            courses.currentSlide = 0;
            if (document.querySelector('.left-slide') === null) {
                dom.toggleSingleClass(courses.pictures[courses.currentSlide], 'left-slide');
            }

            if (document.querySelector('.left-slide--none') !== null) {
                dom.toggleSingleClass(courses.pictures[courses.currentSlide], 'left-slide--none');
            }

            if (document.querySelector('.right-slide') !== null) {
                dom.toggleSingleClass(courses.pictures[courses.currentSlide + 1], 'right-slide');
            }

            if (document.querySelector('.right-slide--none') === null) {
                dom.toggleSingleClass(courses.pictures[courses.currentSlide + 1], 'right-slide--none');
            }
        },
        2: () => {
            courses.currentSlide = 1;
            if (document.querySelector('.right-slide') === null) {
                dom.toggleSingleClass(courses.pictures[courses.currentSlide], 'right-slide');
            }

            if (document.querySelector('.right-slide--none') !== null) {
                dom.toggleSingleClass(courses.pictures[courses.currentSlide], 'right-slide--none');
            }

            if (document.querySelector('.left-slide') !== null) {
                dom.toggleSingleClass(courses.pictures[courses.currentSlide - 1], 'left-slide');
            }

            if (document.querySelector('.left-slide--none') === null) {
                dom.toggleSingleClass(courses.pictures[courses.currentSlide - 1], 'left-slide--none');
            }
        }
    },
    checkSelectedController: () => {
        let controllerSelected = courses.defaultSelectedCourse;
        for (let i = 0; i < courses.courseLinks.length; i++) {
            if ($(courses.courseLinks[i]).hasClass('selected')) {
                controllerSelected = i + 1;
            }
        }

        return controllerSelected;
    },
    update: function() {
        let value = 'translateX(' + (50 * -courses.currentSlide) + '%)';
        dom.setProperty(courses.carrousel, 'transform', value);
    },
    toggleControllers: (selectedController) => {
        dom.toggleSingleClass($('.description-options > .selected'), 'selected');
        dom.toggleSingleClass($(courses.courseLinks[selectedController]), 'selected');
    },
    changeSliderBackground: [
        (element) => {
            dom.setProperty(element, 'background','#000000');
        },
        (element) => {
            dom.setProperty(element, 'background','#C80B0B');
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
        let value = 'translateX(' + (50 * -courses.currentSlide) + '%)';
        dom.setProperty(courses.carrousel, 'transform', value);
    },
};

if (document.querySelector('.note_carrousel') !== null) {
    $(document).ready(press.init);
    $(window).resize(press.init);
}

if (document.querySelector('.course-descriptions') !== null) {
    window.addEventListener('load', courses.init);
    $(window).resize(courses.init);
}