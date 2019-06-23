import dom from '../main/dom';
import breakpoints from '../main/breakpoints';

let chineseCourses = {
    init: () => {
        window.addEventListener('load', chineseCourses.setup);
        window.addEventListener('resize',chineseCourses.setup);
    },
    courses: document.querySelectorAll('.description-base'),
    coursesHolder: document.querySelector('.course-descriptions'),
    setup: () => {
        dom.expandToViewport(chineseCourses.coursesHolder);
        chineseCourses.setSizeCourses();
    },
    setSizeCourses: () => {
        for (let i = 0; i < chineseCourses.courses.length; i++) {
            dom.expandToViewport(chineseCourses.courses[i]);
        }
    },
};

if (document.querySelector('.course-descriptions') !== null) {
    chineseCourses.init();
}