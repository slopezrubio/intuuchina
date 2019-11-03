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
        console.log($(press.carrousel).width());
        console.log("hola");
        $(press.carrousel).width(press.pictureHolder * press.pictures.length);

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

            if (event.type === 'load') {
                // Slides the carrousel according to the controller (Presencial or Online) selected
                courses.moveTo(courses.checkSelectedController() - 1);

                // Changes the background according to the slide requested in the server
                courses.changeSliderBackground[courses.checkSelectedController() - 1](courses.carrousel);

                /*
                 * Add transition to the carrousel so that the next time a course is selected it moves himself
                 * smoothly to reach the corresponding slide. The timeout is set in order to prevent the slide
                 * from applying the transition the first time the page is loaded by a request so it could be
                 * loaded faster.
                 */
                setTimeout(courses.addTransition, 100);
            }

        } else {
            let elementCount =  courses.pictures.length;

            // Events arranged to the clickable elements in the courses slider
            for (let i = 0; i < elementCount; i++) {
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

            // Sets the course slider UI ready to be displayed in desktop devices
            courses.changeSliderBackground[courses.checkSelectedController() - 1](courses.carrousel);
            courses.setDesktopSliders[courses.checkSelectedController()]();
            courses.resetResponsiveSliders();
        }

       let  elementCount = courses.courseLinks.length;

        // Events arranged to the slider controllers
        for (let i = 0; i < elementCount; i++) {
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
    addTransition: () => {
        courses.carrousel.classList.add('transition');
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
        let elementsCount = courses.courseLinks.length;
        for (let i = 0; i < elementsCount ; i++) {
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
let register = {
  select: document.querySelector('#inputProgram'),
  industryFieldset: document.querySelector('#industryFieldset'),
  studyFieldset: document.querySelector('#studyFieldset'),
  universityFieldset: document.querySelector('#universityFieldset'),
  showElement: domElement => {
    domElement.classList.remove('hidden')
    domElement.setAttribute('aria-hidden', false)
  },
  hideElement: domElement => {
    domElement.classList.add('hidden')
    domElement.setAttribute('aria-hidden', true)
  },
  checkFields: () => {
    if (register.industryFieldset) {
      if (register.select.value !== 'internship') {
        register.hideElement(register.industryFieldset)
      }
    }

    if (register.studyFieldset) {
      register.hideElement(register.studyFieldset)
    }

    if (register.universityFieldset) {
      register.hideElement(register.universityFieldset)
    }
  },
  setFields: (selectorValue) => {
    switch (selectorValue) {
      case 'internship':
      case 'inter_relocat':
      case 'inter_housing':
        register.showElement(register.industryFieldset)
        register.hideElement(register.studyFieldset)
        register.hideElement(register.universityFieldset)
        break
      case 'study':
        register.showElement(register.studyFieldset)
        register.hideElement(register.industryFieldset)
        register.hideElement(register.universityFieldset)
        break
      case 'university':
        register.showElement(register.universityFieldset)
        register.hideElement(register.industryFieldset)
        register.hideElement(register.studyFieldset)
      default:
        register.hideElement(register.studyFieldset)
        register.hideElement(register.industryFieldset)
        register.showElement(register.universityFieldset)
        break
    }
  },
  init: () => {
    window.addEventListener('load', register.setFields(register.select.value))
    register.select.addEventListener('change', event => {
      register.setFields(event.target.value)
    })
  }
};

if (register.select !== null) {
  register.init();
}

// const select = document.querySelector('#inputProgram')
// const industryFieldset = document.querySelector('#industryFieldset')
// const studyFieldset = document.querySelector('#studyFieldset')
// const universityFieldset = document.querySelector('#universityFieldset')
//
// const showElement = (domElement) => {
//   domElement.classList.remove('hidden')
//   domElement.setAttribute('aria-hidden', false)
// }

// const hideElement = (domElement) => {
//   domElement.classList.add('hidden')
//   domElement.setAttribute('aria-hidden', true)
// }





import breakpoints from '../main/breakpoints';
import dom from '../main/dom';

let nav = {
    init: () => {
        nav.setup();
    },
    setup: () => {
        window.addEventListener('load', function() {
            if (nav.hasErrorsMessages(nav.modalForm)) {
                nav.showModal();
            };
        });

        for (let i=0; i < nav.accordionSubmenus.length; i++) {
            nav.accordionSubmenus[i].addEventListener('mouseover', nav.highlightItem, true);
            nav.accordionSubmenus[i].addEventListener('mouseout', nav.highlightItem, true);
        }
    },
    modalForm: document.querySelector('.modal__form') !== null ?  document.querySelector('.modal__form') : null,
    accordionSubmenus:  document.querySelectorAll('.accordion_submenu') !== null ?  document.querySelectorAll('.accordion_submenu') : null,
    highlightItem: function(event) {
        if (window.innerWidth < breakpoints.widths.largeDevices[0]) {
            let pattern = /\s?show\s?/;
            if (this.getAttribute('class').match(pattern)) {
                dom.toggleSingleClass(this.parentElement, 'reverse-colours');
            }
        }
    },
    hasErrorsMessages: (parent) => {
        if ($(parent).find('.is-invalid').length > 0) {
            return true;
        }

        return false;
    },
    showModal: () => {
        $('#loginModal').modal();
    }
}

if (document.getElementsByTagName('nav') !== null) {
    nav.init();
}
let pageTitle = {
    init: () => {
        pageTitle.setup();
    },
    header: document.getElementsByTagName('header')[0],
    setup: () => {
        let currentPage = $(pageTitle.header).attr('id');
        if (pageTitle.pages[currentPage] !== null) {
            if (pageTitle.pages[currentPage] !== undefined) {
                pageTitle.pages[currentPage]();
            }
        }
    },
    pages: {
        'job-description': function() {
            let picture = pageTitle.getDataContent(pageTitle.header);
            pageTitle.header.style.setProperty('background-image',`url(../../storage/images/${picture}`);
        }
    },
    getDataContent: (element) => {
        return $(element).attr('data-content');
    }

};

if (document.getElementsByTagName('header') !== null) {
    pageTitle.init();
}
let offers = {
    form: document.querySelector('.form') !== null ? document.querySelector('.form') : null,
    duration: {
        max: 24,
        min: 1
    },
    init: () => {
        window.addEventListener('load', function(event) {
            offers.setup(event);
        })
    },
    setup: (event) => {
        if (document.querySelector('.items_form') !== null || document.querySelector('.items_form--hidden')) {
            var editor = new Quill('.editor', {
                modules: {
                    toolbar: [
                        [{ header: [4, 5, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }, 'blockquote'],
                        [{ 'indent' : '-1'}, { 'indent' : '+1'}, 'link', 'code-block']
                    ]
                },
                placeholder: 'Write down the job description...',
                theme: 'snow'
            });
        }

        if (offers.form !== null) {
            offers.form.addEventListener('submit', function() {
                let description = document.querySelector('input[name=description]');
                description.value = JSON.stringify(editor.getContents());
            });

            offers.form.querySelector('input[name=duration').onkeypress = function(event) {
                if (!offers.validateKeyPressed(event.key)) {
                    event.preventDefault();
                }
            };

            offers.form.querySelector('input[name=duration').onchange = function(event) {
                this.value = offers.validateDuration(this.value);
            };
        }
    },
    validateKeyPressed: function(key) {
        return Number.isInteger(parseInt(key));
    },
    validateDuration: function(value) {
        if (!(parseInt(value) > offers.duration['min']) || !(parseInt(value) <= offers.duration['max'])) {
            if (parseInt(value) > offers.duration['max']) {
                return offers.duration['max'];
            }

            return offers.duration['min'];
        }

        return value;
    }

}

// Component Events
if (document.querySelector('.dropdown-button')) {
    //document.querySelector('.dropdown-button')..addEventListener('click', displayForm);
    let dropdownButtons = document.querySelectorAll('.dropdown-button');
    for (let i = 0; i < dropdownButtons.length; i++) {
        dropdownButtons[i].addEventListener('click', displayForm);
    }
}

// Component Methods
function displayForm(event) {
    event.preventDefault();
    var formIsDisplayed = $('.items_form').length;

    if (!formIsDisplayed) {
        $('.items_form--hidden').addClass('items_form')
                               .removeClass('items_form--hidden');

        /*
         * Save the Y axis of the bottom of the previous element placed just
         * above the form that is going to be displayed.
         */
        let previousElementPosition = document.querySelector('.offers').offsetTop + document.querySelector('.offers').clientHeight;

        // Scrolls the page where the form is being displayed.
        scrollTo(previousElementPosition);

        // Heads the typing to the first field of the hidden form
        let firstInputOfTheForm = $('.form_body input').filter(':first');
        firstInputOfTheForm.focus();
    }

    if (formIsDisplayed) {
        let itemManagementPosition = document.querySelector('.items_management').offsetTop;
        scrollTo(itemManagementPosition);
        setTimeout(function() {
            $('.items_form').addClass('items_form--hidden')
                .removeClass('items_form')
        }, 500);
    }
}

function scrollTo(target) {
    $("html, body").animate({
        'scrollTop': target
    }, 1000, 'swing');
}

if (document.querySelector('.offers') !== null) {
    offers.init();
}
import messages from '../main/messages';

let offersList = {
    init: () => {
        window.addEventListener('load', offersList.setup);
    },
    inputFilter: document.querySelector('#inputFilter') !== null ? document.querySelector('#inputFilter') : null,
    modalOffer: document.querySelector('#modalOffer') !== null ? document.querySelector('#modalOffer') : null,
    deleteButtons: document.querySelectorAll('.delete') !== null ? document.querySelectorAll('.delete') : null,
    setup: function() {
        offersList.inputFilter.addEventListener('change', function(event) {
            let selectedFilter = offersList.inputFilter.value;
            let path = window.location.pathname + `/filter=${selectedFilter}`;
            offersList.getRequest(path, selectedFilter);
        });

        for (let i = 0; i < offersList.deleteButtons.length; i++) {
            offersList.deleteButtons[i].addEventListener('click', function() {
                offersList.loadModalData(this);
            })
        }
    },
    render: (parentElement, data) => {
        parentElement.innerHTML = data;
    },
    addRemoveFunction: (arr) => {
        (function (arr) {
            arr.forEach(function (item) {
                if (item.hasOwnProperty('remove')) {
                    return;
                }
                Object.defineProperty(item, 'remove', {
                    configurable: true,
                    enumerable: true,
                    writable: true,
                    value: function remove() {
                        if (this.parentNode !== null)
                            this.parentNode.removeChild(this);
                    }
                });
            });
        })([Element.prototype, CharacterData.prototype, DocumentType.prototype]);
    },
    loadModalData: function(element) {
        let chosenOffer = element.getAttribute('data-value');
        let modalForm = document.querySelector('#removeOffer');
        modalForm.setAttribute('action', modalForm.getAttribute('action').replace(/[0-9]+$/, chosenOffer));
        let offerTitle = $(element).parent().parent().siblings('.card-title').text();
        document.querySelector('.modal-body__text').innerHTML = messages.form.advices.removeOffer(offerTitle);
    },
    getRequest: function(path, data = null) {
        $.get({
            url: path,
            cache: false,
            data: data,
            dataType: 'html',
            error: function(xhr, status, error) {
                console.log(error);
            },
            success: function(data, status, xhr) {
                $('.offers').remove();
                $('.items_management').after(data);
            }
        })
    }
};

if (document.querySelector('.offers_list') !== null) {
    offersList.init();
}
import dom from '../main/dom';

let singleOffer = {
    init: () => {
        window.addEventListener('load', singleOffer.setup);
    },
    currentViewport: window.innerWidth,
    currentScrollY: window.scrollY,
    setup: (event) => {
        singleOffer.setImages();
        window.addEventListener('resize', function() {
            singleOffer.currentViewport = singleOffer.getViewport();
        });

        document.querySelector('#jobDescription').innerHTML = singleOffer.showDescription(document.querySelector('#jobDescription').getAttribute('data-html'));

        singleOffer.toggleFixedButton(event);

        window.addEventListener('scroll', function(event) {
            singleOffer.currentScrollY = singleOffer.getScrollY();
            singleOffer.toggleFixedButton(event);
        })
    },
    setImages: function() {
        let picture = singleOffer.getDataContent(document.querySelector('.card_background-image'));
        singleOffer.setProperty(document.querySelector('.card_background-image'), 'background-image', `url('${picture}')`);
    },
    getScrollY: () => {
        return window.scrollY;
    },
    getViewport: () => {
        return window.innerWidth;
    },
    getDataContent: (element) => {
        return $(element).attr('data-content');
    },
    setProperty: (element, property, value) => {
        element.style.setProperty(property,value);
    },
    toggleFixedButton: (event) => {
        let lastSection = ($('.readable_section').last());

        let firstIndex = 0;;
        let position = $(lastSection[firstIndex]).offset().top + lastSection[firstIndex].clientHeight;
        if (singleOffer.theViewportPassedOverHere(position)) {
            if (document.querySelector('.sendable_section--fixed')) {
                let applyNowButton = document.querySelector('.sendable_section--fixed');
                dom.toggleClass(applyNowButton, 'sendable_section--fixed', 'sendable_section');
                if (event.type === 'scroll') {
                    position = window.scrollY + (applyNowButton.clientHeight * 2);
                    singleOffer.scrollTo(position);
                }
            }
        } else {
            if (document.querySelector('.sendable_section')) {
                let applyNowButton = document.querySelector('.sendable_section');
                dom.toggleClass(applyNowButton, 'sendable_section', 'sendable_section--fixed');
            }
        }
    },
    scrollTo: (position) => {
        $("html").animate({
            'scrollTop': position,
        }, 500, 'swing');
    },
    showDescription: function(inputDelta) {
        inputDelta = JSON.parse(inputDelta);
        let tempCont = document.createElement("div");
        (new Quill(tempCont)).setContents(inputDelta);
        return tempCont.getElementsByClassName("ql-editor")[0].innerHTML;
    },
    theViewportPassedOverHere: (y) => {
        return window.pageYOffset + window.innerHeight >= y;
    }
};

if (document.querySelector('#job-description') !== null) {
    singleOffer.init();
}
import ajax from '../main/ajax';

let editOffer = {
    init: () => {
        editOffer.setup();
    },
    form: document.querySelector('#editOffer') !== null ? document.querySelector('#editOffer') : null,
    setup: () => {
        window.addEventListener('load', function(event) {
            editOffer.loadWYSIWYGEditor();
        });

        editOffer.inputPicture.addEventListener('change', function(event) {
            editOffer.picturePreview(this, $(this).siblings('.img-preview'));
        })
    },
    inputPicture: document.getElementById('picture') !== null ? document.getElementById('picture') : null,
    loadWYSIWYGEditor: function() {
        if (document.querySelector('.items_form') !== null || document.querySelector('.items_form--hidden')) {
            var editor = new Quill('.editor', {
                modules: {
                    toolbar: [
                        [{ header: [4, 5, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered' }, {'list': 'bullet'}, 'blockquote'],
                        [{ 'indent' : '-1'}, { 'indent' : '+1'}, 'link', 'code-block']
                    ]
                },
                placeholder: 'Write down the job description...',
                theme: 'snow'
            })
        }

        let delta = document.querySelector('.editor').getAttribute('data-html');
        editOffer.setDeltaToEditor(delta, editor);

        editOffer.form.addEventListener('submit', function() {
            let description = document.querySelector('input[name=description]');
            description.value = JSON.stringify(editor.getContents());
        });
    },
    setDeltaToEditor(delta, editor) {
        editor.setContents(JSON.parse(delta));
    },
    picturePreview: function(input, imgElement) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.addEventListener('load', function(e) {
               $(imgElement).attr('src', e.target.result);
           });

           reader.readAsDataURL(input.files[0])
       }
    }

}

if (document.querySelector('#editOffer') !== null) {
    editOffer.init();
}
import breakpoints from '../main/breakpoints';

let news = {
    init: () => {
        window.addEventListener('load', news.setup);
        window.addEventListener('resize', function() {
            news.polygon.style.height = 'auto';
            news.setup();
        });
    },
    polygon: document.querySelector('.news'),
    currentBreakpoint: null,
    setup: () => {
        news.currentBreakpoint = news.getBreakpoint();
    },
    getBreakpoint: () => {
        let currentWidth = window.innerWidth;
        let breakpointKey = 'largeDevices';
        Object.keys(breakpoints.widths).map(function(key) {
            if (breakpoints.widths[key][1] > currentWidth && breakpoints.widths[key][0] < currentWidth) {
                breakpointKey = key;
            }
        });
        return breakpointKey;
    },
};

if (news.polygon !== null) {
    news.init();
}

export default news;
import news from '../components/_news';
import breakpoints from '../main/breakpoints';

let services = {
    container: document.querySelector('.services'),
    init: () => {
        window.addEventListener('load', services.setup);
        window.addEventListener('resize', services.setup);
    },
    setup: (event) => {
        services.setContainer(event);
    },
    setContainer: (event) => {
        if (news.polygon !== null) {
            let containerTopPosition = services.getContainerPosition();
            let main = $('main');
            let sections = $('main > section');
            Object.keys(sections).forEach(function(key) {
                if (parseInt(key) || key == 0) {
                    if (event.type === 'load') {
                        /*$(sections[key]).css({
                            'position': 'relative',
                            'top': containerTopPosition * -1 + 'px',
                        });*/
                    }

                    /*if (event.type === 'resize') {
                        $(sections[key]).css({
                            'top': containerTopPosition * -1 + 'px',
                        });
                    }*/
                }
            });
            //services.fixPositionRelative(main, containerTopPosition);
        }
    },
    fixPositionRelative: (element, displacedPosition, event) => {
        $(element).height('auto');
        $(element).height($(element).height() - displacedPosition);
    },
    getContainerPosition: () => {
        let percentage = breakpoints.isMediumDevice() ? 0.22 : 0.19;
        return news.polygon.clientHeight * percentage;
    }
}

if (services.container !== null) {
    services.init();
}
import dom from '../main/dom';
import breakpoints from '../main/breakpoints';

let chineseCourses = {
    init: () => {
        window.addEventListener('load', chineseCourses.setup);
        window.addEventListener('resize',chineseCourses.setup);
    },
    courses: document.querySelectorAll('.description-base'),
    cta: document.querySelectorAll('.cta'),
    coursesHolder: document.querySelector('.course-descriptions'),
    setup: (event) => {
        if (event.type === 'load') {
            for (let i = 0; i < chineseCourses.cta.length; i++) {
                chineseCourses.cta[i].addEventListener('click', function(event) {
                    event.stopPropagation();
                })
            }
        }
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
import breakpoints from "../main/breakpoints";
import dom from "../main/dom.js";
import env from '../main/env'

let customerJourney = {
    init: function() {
        if (document.querySelector('.customer-journey')) {
            window.addEventListener('load', customerJourney.setup);
            window.addEventListener('resize', customerJourney.setup);
        }
    },
    element: document.querySelector('.customer-journey') !== undefined ? document.querySelector('.customer-journey') : undefined,
    setup: function(event) {
        customerJourney.setPicture[event.type]();
    },
    setPicture: {
        'load': function() {
            let picture = customerJourney.element.querySelector('img');

            if (breakpoints.isCustomerJourney()) {
                let src = env.paths.public + 'storage/images/infography_' + customerJourney.getLocale() + '_vertical.png';
                picture.setAttribute('src', src);
                dom.toggleClass(customerJourney.element, 'customer-journey--mobile', 'customer-journey');
                return true;
            }

            let src = env.paths.public + 'storage/images/infography_' + customerJourney.getLocale() + '_horizontal.png';
            picture.setAttribute('src', src);
            return true;
        },
        'resize': function() {
            let picture = customerJourney.element.querySelector('img');
            let classPattern = /customer-journey--mobile(\s+|$)/;

            if (breakpoints.isCustomerJourney() && customerJourney.element.getAttribute('class').match(classPattern) === null) {
                let src = env.paths.public + 'storage/images/infography_' + customerJourney.getLocale() + '_vertical.png';
                picture.setAttribute('src', src);
                dom.toggleClass(customerJourney.element, 'customer-journey--mobile', 'customer-journey');

                return true;
            }

            if (!breakpoints.isCustomerJourney() && customerJourney.element.getAttribute('class').match(classPattern)) {
                console.log("matches");
                let src = env.paths.public + 'storage/images/infography_' + customerJourney.getLocale() + '_horizontal.png';
                picture.setAttribute('src', src);
                dom.toggleClass(customerJourney.element, 'customer-journey--mobile', 'customer-journey');

                return true;
            }

            return false;
        }
    },
    getLocale: function() {
        return document.querySelector('html').getAttribute('lang');
    }

};


customerJourney.init();

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



let stats = {
    init: () => {
        $('.count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 4000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    }
}

if (document.querySelector('.sensationalism-stats') !== null) {
    stats.init();
}


import breakpoints from '../main/breakpoints';
import dom from '../main/dom';
import env from '../main/env';

let motifs = {
    sections: document.getElementsByClassName('motifs') !== null ? document.getElementsByClassName('motifs') : null,
    container: document.querySelector('.mx-width') !== null ? document.querySelector('.mx-width') : null,
    motifs: document.querySelectorAll('.motif_card, .motif_picture') !== null ? document.querySelectorAll('.motif_card, .motif_picture') : null,
    highestMotif: '',
    init: () => {
      window.addEventListener('load',motifs.setup);
      window.addEventListener('resize', function() {
          motifs.setup();
      });
    },
    setup: () => {
        motifs.setContainer();
        Object.keys(motifs.preparedFor).map(function(key) {
          motifs.preparedFor[key]();
        });

        motifs.highestMotif = motifs.highestMotif === '' ? motifs.getHighestMotif() : motifs.highestMotif;
        motifs.setHeight();

    },
    getHighestMotif: () => {
        let highest = '';
        for (let i = 0; i < motifs.motifs.length; i++) {
            if (getComputedStyle(motifs.motifs[i], null).display !== 'none' && motifs.motifs[i].getAttribute('class') === "motif_card") {
                highest = highest === '' ? motifs.motifs[i] : highest;
                if (motifs.motifs[i].style.height === '' && motifs.motifs[i].offsetHeight >= highest.offsetHeight) {
                    highest = motifs.motifs[i];
                }
            }
        }

        return highest;

    },
    setHeight: () => {
        for (let i = 0; i < motifs.motifs.length; i++) {
            if (getComputedStyle(motifs.motifs[i], null).display !== 'none') {
                if (!motifs.motifs[i].isEqualNode(motifs.highestMotif)) {
                    if (!breakpoints.isSmallDevice()) {
                        motifs.motifs[i].style.height = '';
                    } else {
                        motifs.motifs[i].style.height = motifs.highestMotif.offsetHeight + 'px';
                    }


                }
            }
            //motifs.motifs[i].style.height = !motifs.motifs[i].isEqualNode(motifs.highestMotif) ? `${motifs.highestMotif.clientHeight}px` : `auto`;
        }
    },
    preparedFor: {
      smallDevice: () => {
        if (!breakpoints.isSmallDevice()) {
            return false;
        };

        if (motifs.currentGrid(motifs.container) !== 'grid-sd') {
            motifs.highestMotif = '';
            dom.toggleClass(motifs.container, motifs.currentGrid(motifs.container), 'grid-sd');
        };

        motifs.placePicturesAsBackground();
      },
      mediumDevice: () => {
          if (!breakpoints.isMediumDevice()) {
              return false;
          };

          if (motifs.currentGrid(motifs.container) !== 'grid-md') {
              dom.toggleClass(motifs.container, motifs.currentGrid(motifs.container), 'grid-md');
          };

          motifs.removePictureAsBackground();
      },
      largeDevice: () => {
          if (!breakpoints.isLargeDevice()) {
              return false;
          };

          if (motifs.currentGrid(motifs.container) !== 'grid-ld') {
              dom.toggleClass(motifs.container, motifs.currentGrid(motifs.container), 'grid-ld');
          };

          motifs.removePictureAsBackground();
      },
    },
    setContainer: () => {
        if (!$(motifs.container).hasClass('shadow')) {
            if (window.innerWidth >= 1382) {
                dom.toggleSingleClass(motifs.container, 'shadow');
                return true;
            }
        };

        if (window.innerWidth < 1382) {
            dom.toggleSingleClass(motifs.container, 'shadow');
        };

        return true;
    },
    removePictureAsBackground: () => {
        if (document.querySelector('.unified') !== null) {
            for (let i= 0; i < motifs.sections.length; i++) {
                if (motifs.sections[i].querySelector('.motif_picture') !== null) {
                    let card = motifs.sections[i].querySelector('.motif_card');
                    $(card).css("background", "none");
                    dom.toggleSingleClass(motifs.sections[i], 'unified');
                    dom.toggleSingleClass(motifs.sections[i], 'black_and_white');
                }
            }
        }
    },
    placePicturesAsBackground: () => {
        if (document.querySelector('.unified') === null) {
            for (let i = 0; i < motifs.sections.length; i++) {
                if (motifs.sections[i].querySelector('.motif_picture') !== null) {
                    let picture = motifs.sections[i].querySelector('.motif_picture').getElementsByTagName('img')[0];
                    dom.toggleSingleClass(motifs.sections[i], 'unified');
                    motifs.setBackgroundImage(picture.getAttribute('src'), motifs.sections[i].querySelector('.motif_card'));
                    dom.toggleSingleClass(motifs.sections[i], 'black_and_white');
                }
            }
        }
    },
    currentGrid: (element) => {
        let pattern = /\s*grid-(m|s|l)d\s*/g;
        let grid = ($(element).attr('class').match(pattern));
        grid = grid[0].replace(/\s/g, '');
        return grid;
    },
    setBackgroundImage: (picture, element) => {
        let filter = /\w+\.(jpe?g|gif|svg|png)$/g;
        picture = picture.replace(/desktop/, 'mobile');
        let url = env.paths.public + 'storage/images/' + picture.match(filter);
        $(element).css("background", 'url(\'' + url + '\') no-repeat scroll center');
        $(element).css("background-size", "cover");
    },
};

if (document.querySelector('.motifs') !== null) {
   motifs.init();
}
import breakpoints from '../main/breakpoints';
import dom from '../main/dom';

let footer = {
    init: function() {
        window.addEventListener('load', footer.setup);
        window.addEventListener('resize', function() {
            footer.setSwitch();
        });
    },
    form: document.querySelector('.footer_contact_form'),
    setup: () => {
        if (footer.hasErrorsMessages(footer.form)) {
            footer.setViewport();
        }
        footer.setSwitch();
    },
    getScreenSize: () => {
        let screenSize = [];
        screenSize.push(window.innerWidth, window.innerHeight);
        return screenSize;
    },
    setSwitch: () => {
        let switchInput = document.querySelector('.switch_input') !== null
            ? document.querySelector('.switch_input')
            : document.querySelector('.checkbox_input');

        if (footer.getScreenSize()[0] > breakpoints.widths.largeDevices) {
            if (document.querySelector('.checkbox_input') === null) {
                dom.toggleClass(switchInput, 'switch_input', 'checkbox_input');
            }
        }

        if (footer.getScreenSize()[0] <= breakpoints.widths.largeDevices) {
            if (document.querySelector('.switch_input') === null) {
                dom.toggleClass(switchInput, 'switch_input', 'checkbox_input');
            }
        }
    },
    hasErrorsMessages: function(parent) {
        if ($(parent).find('.invalid-feedback', '.is-invalid').length > 0) {
            return true;
        }

        return false;
        // let fields = footer.form.querySelectorAll('.col-xs-10');
        // for (let i = 0; i < fields.length && errors === false; i++) {
        //     if (fields[i].querySelector('.is-invalid') !== null) {
        //         errors = true;
        //     }
        // }
        //
        // if (errors) {
        //     return true;
        // }
        // return false;
    },
    setViewport: () => {
        /*
         * Obtiene la diferencia de scroll entre la del usuario y la del formulario
         * del pie de página.
         */
        let scrollToForm = footer.form.offsetTop - window.scrollY;

        /*
         * Realiza el scroll hasta el formulario de pie de página.
         */
        window.scrollBy(0, scrollToForm);
    },
};

if (document.querySelector('.footer') !== null) {
    footer.init();
}