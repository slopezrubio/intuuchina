import DOM from '../main/dom';

var chineseCourses = {
    init: function() {
        window.addEventListener('load', (e) => {
            this[e.type + 'Listeners']();
            this.loadCoursesHolder();
        });
        window.addEventListener('resize',(e) => {
            this.loadCoursesHolder();
        });
    },
    courses: document.querySelectorAll('.description-base'),
    cta: document.querySelectorAll('.cta'),
    coursesHolder: document.querySelector('.course-descriptions'),
    loadListeners: function() {
        for (let i = 0; i < this.cta.length; i++) {
            this.cta[i].addEventListener('click', function(event) {
                event.stopPropagation();
            })
        }
    },
    loadCoursesHolder: function() {
        DOM.expandToViewport(chineseCourses.coursesHolder);
        this.setSizeCourses();
    },
        // if (event.type === 'load') {
        //     for (let i = 0; i < chineseCourses.cta.length; i++) {
        //         chineseCourses.cta[i].addEventListener('click', function(event) {
        //             event.stopPropagation();
        //         })
        //     }
        // }
        // DOM.expandToViewport(chineseCourses.coursesHolder);
        // this.setSizeCourses();
    setSizeCourses: function() {
        for (let i = 0; i < this.courses.length; i++) {
            DOM.expandToViewport(this.courses[i]);
        }
    },
};

if (document.querySelector('.course-descriptions') !== null) {
    chineseCourses.init();
}