import DOM from '../main/dom';
import MediaQueries from "../main/breakpoints";
import { arrowSliderFactory } from './ArrowSlider';
import { mediaSliderFactory } from './MediaSlider';
import { peopleSliderFactory } from './PeopleSlider';
import api from '../main/api.js';

var pressNote = function() {
    var mediaSlider = null;

    function init() {
        var mediaSlider = new mediaSliderFactory.createSlider({
            type: 'media',
        });
    }

    init();
};

var learnChinese = function() {
    var arrowSlider = null;

    function replaceCourseInfoSection(newCourseInfoSection) {
        $('section#course-info').remove();
        $('section.arrow-slider').after(newCourseInfoSection);
    }

    function init() {
        var arrowSlider = arrowSliderFactory.createSlider({
            type: 'arrow',
            controllersCallback: function (slider) {
                let course = slider.querySelector("input[name='study'").getAttribute('value');
                api.getCourseInfo(course, replaceCourseInfoSection);
            }
        });
    }

    init();
};

var university = function() {
    var arrowSlider = null;

    function replaceCourseInfoSection(newCourseInfoSection) {
        $('section#course-info').remove();
        $('section.arrow-slider').after(newCourseInfoSection);
    }

    function init() {
        var arrowSlider = arrowSliderFactory.createSlider({
            type: 'arrow',
        });
    }

    init();
};

var testimonials = function() {
    var peopleSlider = null;

    function init() {
        var peopleSlider = peopleSliderFactory.createSlider({
            type: 'people',
            interval: 5000,
            duration: 550,
        });
    }

    init();
};

window.addEventListener('load', function() {
    if (document.querySelector('.note_carrousel') !== null) {
        // $(document).ready(press.init);
        // $(window).resize(press.init);
        pressNote();
    }

    if (document.querySelector('main#learn-chinese') !== null) {
        learnChinese();
    }

    if (document.querySelector('main#university') !== null) {
        university();
    }

    if (document.querySelector('section.people-slider') !== null) {
        testimonials();
    }
});
