/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/components/_chinese-courses.js":
/*!*****************************************************!*\
  !*** ./resources/js/components/_chinese-courses.js ***!
  \*****************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_dom__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../main/dom */ "./resources/js/main/dom.js");
/* harmony import */ var _main_breakpoints__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../main/breakpoints */ "./resources/js/main/breakpoints.js");


var chineseCourses = {
  init: function init() {
    window.addEventListener('load', chineseCourses.setup);
    window.addEventListener('resize', chineseCourses.setup);
  },
  courses: document.querySelectorAll('.description-base'),
  cta: document.querySelectorAll('.cta'),
  coursesHolder: document.querySelector('.course-descriptions'),
  setup: function setup(event) {
    if (event.type === 'load') {
      for (var i = 0; i < chineseCourses.cta.length; i++) {
        chineseCourses.cta[i].addEventListener('click', function (event) {
          event.stopPropagation();
        });
      }
    }

    _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].expandToViewport(chineseCourses.coursesHolder);
    chineseCourses.setSizeCourses();
  },
  setSizeCourses: function setSizeCourses() {
    for (var i = 0; i < chineseCourses.courses.length; i++) {
      _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].expandToViewport(chineseCourses.courses[i]);
    }
  }
};

if (document.querySelector('.course-descriptions') !== null) {
  chineseCourses.init();
}

/***/ }),

/***/ "./resources/js/components/_customer-journey.js":
/*!******************************************************!*\
  !*** ./resources/js/components/_customer-journey.js ***!
  \******************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_breakpoints__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../main/breakpoints */ "./resources/js/main/breakpoints.js");
/* harmony import */ var _main_dom_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../main/dom.js */ "./resources/js/main/dom.js");
/* harmony import */ var _main_env__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../main/env */ "./resources/js/main/env.js");



var customerJourney = {
  init: function init() {
    if (document.querySelector('.customer-journey')) {
      window.addEventListener('load', customerJourney.setup);
      window.addEventListener('resize', customerJourney.setup);
    }
  },
  element: document.querySelector('.customer-journey') !== undefined ? document.querySelector('.customer-journey') : undefined,
  setup: function setup(event) {
    customerJourney.setPicture[event.type]();
  },
  setPicture: {
    'load': function load() {
      var picture = customerJourney.element.querySelector('img');

      if (_main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].isCustomerJourney()) {
        var _src = _main_env__WEBPACK_IMPORTED_MODULE_2__["default"].paths["public"] + 'storage/images/infography_' + customerJourney.getLocale() + '_vertical.png';

        picture.setAttribute('src', _src);
        _main_dom_js__WEBPACK_IMPORTED_MODULE_1__["default"].toggleClass(customerJourney.element, 'customer-journey--mobile', 'customer-journey');
        return true;
      }

      var src = _main_env__WEBPACK_IMPORTED_MODULE_2__["default"].paths["public"] + 'storage/images/infography_' + customerJourney.getLocale() + '_horizontal.png';
      picture.setAttribute('src', src);
      return true;
    },
    'resize': function resize() {
      var picture = customerJourney.element.querySelector('img');
      var classPattern = /customer-journey--mobile(\s+|$)/;

      if (_main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].isCustomerJourney() && customerJourney.element.getAttribute('class').match(classPattern) === null) {
        var src = _main_env__WEBPACK_IMPORTED_MODULE_2__["default"].paths["public"] + 'storage/images/infography_' + customerJourney.getLocale() + '_vertical.png';
        picture.setAttribute('src', src);
        _main_dom_js__WEBPACK_IMPORTED_MODULE_1__["default"].toggleClass(customerJourney.element, 'customer-journey--mobile', 'customer-journey');
        return true;
      }

      if (!_main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].isCustomerJourney() && customerJourney.element.getAttribute('class').match(classPattern)) {
        console.log("matches");

        var _src2 = _main_env__WEBPACK_IMPORTED_MODULE_2__["default"].paths["public"] + 'storage/images/infography_' + customerJourney.getLocale() + '_horizontal.png';

        picture.setAttribute('src', _src2);
        _main_dom_js__WEBPACK_IMPORTED_MODULE_1__["default"].toggleClass(customerJourney.element, 'customer-journey--mobile', 'customer-journey');
        return true;
      }

      return false;
    }
  },
  getLocale: function getLocale() {
    return document.querySelector('html').getAttribute('lang');
  }
};
customerJourney.init();

/***/ }),

/***/ "./resources/js/components/_edit-offer.js":
/*!************************************************!*\
  !*** ./resources/js/components/_edit-offer.js ***!
  \************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_ajax__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../main/ajax */ "./resources/js/main/ajax.js");

var editOffer = {
  init: function init() {
    editOffer.setup();
  },
  form: document.querySelector('#editOffer') !== null ? document.querySelector('#editOffer') : null,
  setup: function setup() {
    window.addEventListener('load', function (event) {
      editOffer.loadWYSIWYGEditor();
    });
    editOffer.inputPicture.addEventListener('change', function (event) {
      editOffer.picturePreview(this, $(this).siblings('.img-preview'));
    });
  },
  inputPicture: document.getElementById('picture') !== null ? document.getElementById('picture') : null,
  loadWYSIWYGEditor: function loadWYSIWYGEditor() {
    if (document.querySelector('.items_form') !== null || document.querySelector('.items_form--hidden')) {
      var editor = new Quill('.editor', {
        modules: {
          toolbar: [[{
            header: [4, 5, false]
          }], ['bold', 'italic', 'underline'], [{
            'list': 'ordered'
          }, {
            'list': 'bullet'
          }, 'blockquote'], [{
            'indent': '-1'
          }, {
            'indent': '+1'
          }, 'link', 'code-block']]
        },
        placeholder: 'Write down the job description...',
        theme: 'snow'
      });
    }

    var delta = document.querySelector('.editor').getAttribute('data-html');
    editOffer.setDeltaToEditor(delta, editor);
    editOffer.form.addEventListener('submit', function () {
      var description = document.querySelector('input[name=description]');
      description.value = JSON.stringify(editor.getContents());
    });
  },
  setDeltaToEditor: function setDeltaToEditor(delta, editor) {
    editor.setContents(JSON.parse(delta));
  },
  picturePreview: function picturePreview(input, imgElement) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.addEventListener('load', function (e) {
        $(imgElement).attr('src', e.target.result);
      });
      reader.readAsDataURL(input.files[0]);
    }
  }
};

if (document.querySelector('#editOffer') !== null) {
  editOffer.init();
}

/***/ }),

/***/ "./resources/js/components/_filter-by.js":
/*!***********************************************!*\
  !*** ./resources/js/components/_filter-by.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var filterBy = {
  init: function init() {
    addEventListener('resize', filterBy.upload);
  },
  selector: document.querySelector('.custom-select-wrapper'),
  arrowBackgroundWidth: 62,
  upload: function upload() {
    filterBy.moveArrow();
  },
  moveArrow: function moveArrow() {
    var property = 'background-image';
    var value = 'linear-gradient(to right, black ' + (filterBy.selector.clientWidth - filterBy.arrowBackgroundWidth) + 'px, #B71C1C 70px)';
    $(filterBy.selector).css(property, value);
  }
};

if (document.querySelector('.custom-select-wrapper') !== null) {
  filterBy.init();
}

/***/ }),

/***/ "./resources/js/components/_footer.js":
/*!********************************************!*\
  !*** ./resources/js/components/_footer.js ***!
  \********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_breakpoints__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../main/breakpoints */ "./resources/js/main/breakpoints.js");
/* harmony import */ var _main_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../main/dom */ "./resources/js/main/dom.js");


var footer = {
  init: function init() {
    window.addEventListener('load', footer.setup);
    window.addEventListener('resize', function () {
      footer.setSwitch();
    });
  },
  form: document.querySelector('.footer_contact_form'),
  setup: function setup() {
    if (footer.hasErrorsMessages(footer.form)) {
      footer.setViewport();
    }

    footer.setSwitch();
  },
  getScreenSize: function getScreenSize() {
    var screenSize = [];
    screenSize.push(window.innerWidth, window.innerHeight);
    return screenSize;
  },
  setSwitch: function setSwitch() {
    var switchInput = document.querySelector('.switch_input') !== null ? document.querySelector('.switch_input') : document.querySelector('.checkbox_input');

    if (footer.getScreenSize()[0] > _main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].widths.largeDevices) {
      if (document.querySelector('.checkbox_input') === null) {
        _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleClass(switchInput, 'switch_input', 'checkbox_input');
      }
    }

    if (footer.getScreenSize()[0] <= _main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].widths.largeDevices) {
      if (document.querySelector('.switch_input') === null) {
        _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleClass(switchInput, 'switch_input', 'checkbox_input');
      }
    }
  },
  hasErrorsMessages: function hasErrorsMessages(parent) {
    if ($(parent).find('.invalid-feedback', '.is-invalid').length > 0) {
      return true;
    }

    return false; // let fields = footer.form.querySelectorAll('.col-xs-10');
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
  setViewport: function setViewport() {
    /*
     * Obtiene la diferencia de scroll entre la del usuario y la del formulario
     * del pie de página.
     */
    var scrollToForm = footer.form.offsetTop - window.scrollY;
    /*
     * Realiza el scroll hasta el formulario de pie de página.
     */

    window.scrollBy(0, scrollToForm);
  }
};

if (document.querySelector('.footer') !== null) {
  footer.init();
}

/***/ }),

/***/ "./resources/js/components/_motifs.js":
/*!********************************************!*\
  !*** ./resources/js/components/_motifs.js ***!
  \********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_breakpoints__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../main/breakpoints */ "./resources/js/main/breakpoints.js");
/* harmony import */ var _main_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../main/dom */ "./resources/js/main/dom.js");
/* harmony import */ var _main_env__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../main/env */ "./resources/js/main/env.js");



var motifs = {
  sections: document.getElementsByClassName('motifs') !== null ? document.getElementsByClassName('motifs') : null,
  container: document.querySelector('.mx-width') !== null ? document.querySelector('.mx-width') : null,
  motifs: document.querySelectorAll('.motif_card, .motif_picture') !== null ? document.querySelectorAll('.motif_card, .motif_picture') : null,
  highestMotif: '',
  init: function init() {
    window.addEventListener('load', motifs.setup);
    window.addEventListener('resize', function () {
      motifs.setup();
    });
  },
  setup: function setup() {
    motifs.setContainer();
    Object.keys(motifs.preparedFor).map(function (key) {
      motifs.preparedFor[key]();
    });
    motifs.highestMotif = motifs.highestMotif === '' ? motifs.getHighestMotif() : motifs.highestMotif;
    motifs.setHeight();
  },
  getHighestMotif: function getHighestMotif() {
    var highest = '';

    for (var i = 0; i < motifs.motifs.length; i++) {
      if (getComputedStyle(motifs.motifs[i], null).display !== 'none' && motifs.motifs[i].getAttribute('class') === "motif_card") {
        highest = highest === '' ? motifs.motifs[i] : highest;

        if (motifs.motifs[i].style.height === '' && motifs.motifs[i].offsetHeight >= highest.offsetHeight) {
          highest = motifs.motifs[i];
        }
      }
    }

    return highest;
  },
  setHeight: function setHeight() {
    for (var i = 0; i < motifs.motifs.length; i++) {
      if (getComputedStyle(motifs.motifs[i], null).display !== 'none') {
        if (!motifs.motifs[i].isEqualNode(motifs.highestMotif)) {
          if (!_main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].isSmallDevice()) {
            motifs.motifs[i].style.height = '';
          } else {
            motifs.motifs[i].style.height = motifs.highestMotif.offsetHeight + 'px';
          }
        }
      } //motifs.motifs[i].style.height = !motifs.motifs[i].isEqualNode(motifs.highestMotif) ? `${motifs.highestMotif.clientHeight}px` : `auto`;

    }
  },
  preparedFor: {
    smallDevice: function smallDevice() {
      if (!_main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].isSmallDevice()) {
        return false;
      }

      ;

      if (motifs.currentGrid(motifs.container) !== 'grid-sd') {
        motifs.highestMotif = '';
        _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleClass(motifs.container, motifs.currentGrid(motifs.container), 'grid-sd');
      }

      ;
      motifs.placePicturesAsBackground();
    },
    mediumDevice: function mediumDevice() {
      if (!_main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].isMediumDevice()) {
        return false;
      }

      ;

      if (motifs.currentGrid(motifs.container) !== 'grid-md') {
        _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleClass(motifs.container, motifs.currentGrid(motifs.container), 'grid-md');
      }

      ;
      motifs.removePictureAsBackground();
    },
    largeDevice: function largeDevice() {
      if (!_main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].isLargeDevice()) {
        return false;
      }

      ;

      if (motifs.currentGrid(motifs.container) !== 'grid-ld') {
        _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleClass(motifs.container, motifs.currentGrid(motifs.container), 'grid-ld');
      }

      ;
      motifs.removePictureAsBackground();
    }
  },
  setContainer: function setContainer() {
    if (!$(motifs.container).hasClass('shadow')) {
      if (window.innerWidth >= 1382) {
        _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(motifs.container, 'shadow');
        return true;
      }
    }

    ;

    if (window.innerWidth < 1382) {
      _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(motifs.container, 'shadow');
    }

    ;
    return true;
  },
  removePictureAsBackground: function removePictureAsBackground() {
    if (document.querySelector('.unified') !== null) {
      for (var i = 0; i < motifs.sections.length; i++) {
        if (motifs.sections[i].querySelector('.motif_picture') !== null) {
          var card = motifs.sections[i].querySelector('.motif_card');
          $(card).css("background", "none");
          _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(motifs.sections[i], 'unified');
          _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(motifs.sections[i], 'black_and_white');
        }
      }
    }
  },
  placePicturesAsBackground: function placePicturesAsBackground() {
    if (document.querySelector('.unified') === null) {
      for (var i = 0; i < motifs.sections.length; i++) {
        if (motifs.sections[i].querySelector('.motif_picture') !== null) {
          var picture = motifs.sections[i].querySelector('.motif_picture').getElementsByTagName('img')[0];
          _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(motifs.sections[i], 'unified');
          motifs.setBackgroundImage(picture.getAttribute('src'), motifs.sections[i].querySelector('.motif_card'));
          _main_dom__WEBPACK_IMPORTED_MODULE_1__["default"].toggleSingleClass(motifs.sections[i], 'black_and_white');
        }
      }
    }
  },
  currentGrid: function currentGrid(element) {
    var pattern = /\s*grid-(m|s|l)d\s*/g;
    var grid = $(element).attr('class').match(pattern);
    grid = grid[0].replace(/\s/g, '');
    return grid;
  },
  setBackgroundImage: function setBackgroundImage(picture, element) {
    var filter = /\w+\.(jpe?g|gif|svg|png)$/g;
    picture = picture.replace(/desktop/, 'mobile');
    var url = _main_env__WEBPACK_IMPORTED_MODULE_2__["default"].paths["public"] + 'storage/images/' + picture.match(filter);
    $(element).css("background", 'url(\'' + url + '\') no-repeat scroll center');
    $(element).css("background-size", "cover");
  }
};

if (document.querySelector('.motifs') !== null) {
  motifs.init();
}

/***/ }),

/***/ "./resources/js/components/_nav.js":
/*!*****************************************!*\
  !*** ./resources/js/components/_nav.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var nav = {
  init: function init() {
    nav.setup();
  },
  setup: function setup() {
    window.addEventListener('load', function () {
      if (nav.hasErrorsMessages(nav.modalForm)) {
        nav.showModal();
      }

      ;
    });

    for (var i = 0; i < nav.accordionSubmenus.length; i++) {
      nav.accordionSubmenus[i].addEventListener('mouseover', nav.highlightItem, true);
      nav.accordionSubmenus[i].addEventListener('mouseout', nav.highlightItem, true);
    }
  },
  modalForm: document.querySelector('.modal__form') !== null ? document.querySelector('.modal__form') : null,
  accordionSubmenus: document.querySelectorAll('.accordion_submenu') !== null ? document.querySelectorAll('.accordion_submenu') : null,
  highlightItem: function highlightItem(event) {
    if (window.innerWidth < breakpoints.widths.largeDevices[0]) {
      var pattern = /\s?show\s?/;

      if (this.getAttribute('class').match(pattern)) {
        dom.toggleSingleClass(this.parentElement, 'reverse-colours');
      }
    }
  },
  hasErrorsMessages: function hasErrorsMessages(parent) {
    if ($(parent).find('.is-invalid').length > 0) {
      return true;
    }

    return false;
  },
  showModal: function showModal() {
    $('#loginModal').modal();
  }
};

if (document.getElementsByTagName('nav') !== null) {
  nav.init();
}

/***/ }),

/***/ "./resources/js/components/_news.js":
/*!******************************************!*\
  !*** ./resources/js/components/_news.js ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_breakpoints__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../main/breakpoints */ "./resources/js/main/breakpoints.js");

var news = {
  init: function init() {
    window.addEventListener('load', news.setup);
    window.addEventListener('resize', function () {
      news.polygon.style.height = 'auto';
      news.setup();
    });
  },
  polygon: document.querySelector('.news'),
  currentBreakpoint: null,
  setup: function setup() {
    news.currentBreakpoint = news.getBreakpoint();
  },
  getBreakpoint: function getBreakpoint() {
    var currentWidth = window.innerWidth;
    var breakpointKey = 'largeDevices';
    Object.keys(_main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].widths).map(function (key) {
      if (_main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].widths[key][1] > currentWidth && _main_breakpoints__WEBPACK_IMPORTED_MODULE_0__["default"].widths[key][0] < currentWidth) {
        breakpointKey = key;
      }
    });
    return breakpointKey;
  }
};

if (news.polygon !== null) {
  news.init();
}

/* harmony default export */ __webpack_exports__["default"] = (news);

/***/ }),

/***/ "./resources/js/components/_offers-list.js":
/*!*************************************************!*\
  !*** ./resources/js/components/_offers-list.js ***!
  \*************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_messages__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../main/messages */ "./resources/js/main/messages.js");

var offersList = {
  init: function init() {
    window.addEventListener('load', offersList.setup);
  },
  inputFilter: document.querySelector('#inputFilter') !== null ? document.querySelector('#inputFilter') : null,
  modalOffer: document.querySelector('#modalOffer') !== null ? document.querySelector('#modalOffer') : null,
  deleteButtons: document.querySelectorAll('.delete') !== null ? document.querySelectorAll('.delete') : null,
  setup: function setup() {
    offersList.inputFilter.addEventListener('change', function (event) {
      var selectedFilter = offersList.inputFilter.value;
      var path = window.location.pathname + "/filter=".concat(selectedFilter);
      offersList.getRequest(path, selectedFilter);
    });

    for (var i = 0; i < offersList.deleteButtons.length; i++) {
      offersList.deleteButtons[i].addEventListener('click', function () {
        offersList.loadModalData(this);
      });
    }
  },
  render: function render(parentElement, data) {
    parentElement.innerHTML = data;
  },
  addRemoveFunction: function addRemoveFunction(arr) {
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
            if (this.parentNode !== null) this.parentNode.removeChild(this);
          }
        });
      });
    })([Element.prototype, CharacterData.prototype, DocumentType.prototype]);
  },
  loadModalData: function loadModalData(element) {
    var chosenOffer = element.getAttribute('data-value');
    var modalForm = document.querySelector('#removeOffer');
    modalForm.setAttribute('action', modalForm.getAttribute('action').replace(/[0-9]+$/, chosenOffer));
    var offerTitle = $(element).parent().parent().siblings('.card-title').text();
    document.querySelector('.modal-body__text').innerHTML = _main_messages__WEBPACK_IMPORTED_MODULE_0__["default"].form.advices.removeOffer(offerTitle);
  },
  getRequest: function getRequest(path) {
    var data = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
    $.get({
      url: path,
      cache: false,
      data: data,
      dataType: 'html',
      error: function error(xhr, status, _error) {
        console.log(_error);
      },
      success: function success(data, status, xhr) {
        $('.offers').remove();
        $('.items_management').after(data);
      }
    });
  }
};

if (document.querySelector('.offers_list') !== null) {
  offersList.init();
}

/***/ }),

/***/ "./resources/js/components/_offers.js":
/*!********************************************!*\
  !*** ./resources/js/components/_offers.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var offers = {
  form: document.querySelector('.form') !== null ? document.querySelector('.form') : null,
  duration: {
    max: 24,
    min: 1
  },
  init: function init() {
    window.addEventListener('load', function (event) {
      offers.setup(event);
    });
  },
  setup: function setup(event) {
    if (document.querySelector('.items_form') !== null || document.querySelector('.items_form--hidden')) {
      var editor = new Quill('.editor', {
        modules: {
          toolbar: [[{
            header: [4, 5, false]
          }], ['bold', 'italic', 'underline'], [{
            'list': 'ordered'
          }, {
            'list': 'bullet'
          }, 'blockquote'], [{
            'indent': '-1'
          }, {
            'indent': '+1'
          }, 'link', 'code-block']]
        },
        placeholder: 'Write down the job description...',
        theme: 'snow'
      });
    }

    if (offers.form !== null) {
      offers.form.addEventListener('submit', function () {
        var description = document.querySelector('input[name=description]');
        description.value = JSON.stringify(editor.getContents());
      });

      offers.form.querySelector('input[name=duration').onkeypress = function (event) {
        if (!offers.validateKeyPressed(event.key)) {
          event.preventDefault();
        }
      };

      offers.form.querySelector('input[name=duration').onchange = function (event) {
        this.value = offers.validateDuration(this.value);
      };
    }
  },
  validateKeyPressed: function validateKeyPressed(key) {
    return Number.isInteger(parseInt(key));
  },
  validateDuration: function validateDuration(value) {
    if (!(parseInt(value) > offers.duration['min']) || !(parseInt(value) <= offers.duration['max'])) {
      if (parseInt(value) > offers.duration['max']) {
        return offers.duration['max'];
      }

      return offers.duration['min'];
    }

    return value;
  } // Component Events

};

if (document.querySelector('.dropdown-button')) {
  //document.querySelector('.dropdown-button')..addEventListener('click', displayForm);
  var dropdownButtons = document.querySelectorAll('.dropdown-button');

  for (var i = 0; i < dropdownButtons.length; i++) {
    dropdownButtons[i].addEventListener('click', displayForm);
  }
} // Component Methods


function displayForm(event) {
  event.preventDefault();
  var formIsDisplayed = $('.items_form').length;

  if (!formIsDisplayed) {
    $('.items_form--hidden').addClass('items_form').removeClass('items_form--hidden');
    /*
     * Save the Y axis of the bottom of the previous element placed just
     * above the form that is going to be displayed.
     */

    var previousElementPosition = document.querySelector('.offers').offsetTop + document.querySelector('.offers').clientHeight; // Scrolls the page where the form is being displayed.

    scrollTo(previousElementPosition); // Heads the typing to the first field of the hidden form

    var firstInputOfTheForm = $('.form_body input').filter(':first');
    firstInputOfTheForm.focus();
  }

  if (formIsDisplayed) {
    var itemManagementPosition = document.querySelector('.items_management').offsetTop;
    scrollTo(itemManagementPosition);
    setTimeout(function () {
      $('.items_form').addClass('items_form--hidden').removeClass('items_form');
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

/***/ }),

/***/ "./resources/js/components/_page-title.js":
/*!************************************************!*\
  !*** ./resources/js/components/_page-title.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var pageTitle = {
  init: function init() {
    pageTitle.setup();
  },
  header: document.getElementsByTagName('header')[0],
  setup: function setup() {
    var currentPage = $(pageTitle.header).attr('id');

    if (pageTitle.pages[currentPage] !== null) {
      if (pageTitle.pages[currentPage] !== undefined) {
        pageTitle.pages[currentPage]();
      }
    }
  },
  pages: {
    'job-description': function jobDescription() {
      var picture = pageTitle.getDataContent(pageTitle.header);
      pageTitle.header.style.setProperty('background-image', "url(../../storage/images/".concat(picture));
    }
  },
  getDataContent: function getDataContent(element) {
    return $(element).attr('data-content');
  }
};

if (document.getElementsByTagName('header') !== null) {
  pageTitle.init();
}

/***/ }),

/***/ "./resources/js/components/_register.js":
/*!**********************************************!*\
  !*** ./resources/js/components/_register.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var register = {
  select: document.querySelector('#inputProgram'),
  industryFieldset: document.querySelector('#industryFieldset'),
  studyFieldset: document.querySelector('#studyFieldset'),
  universityFieldset: document.querySelector('#universityFieldset'),
  showElement: function showElement(domElement) {
    domElement.classList.remove('hidden');
    domElement.setAttribute('aria-hidden', false);
  },
  hideElement: function hideElement(domElement) {
    domElement.classList.add('hidden');
    domElement.setAttribute('aria-hidden', true);
  },
  checkFields: function checkFields() {
    if (register.industryFieldset) {
      if (register.select.value !== 'internship') {
        register.hideElement(register.industryFieldset);
      }
    }

    if (register.studyFieldset) {
      register.hideElement(register.studyFieldset);
    }

    if (register.universityFieldset) {
      register.hideElement(register.universityFieldset);
    }
  },
  setFields: function setFields(selectorValue) {
    switch (selectorValue) {
      case 'internship':
      case 'inter_relocat':
      case 'inter_housing':
        register.showElement(register.industryFieldset);
        register.hideElement(register.studyFieldset);
        register.hideElement(register.universityFieldset);
        break;

      case 'study':
        register.showElement(register.studyFieldset);
        register.hideElement(register.industryFieldset);
        register.hideElement(register.universityFieldset);
        break;

      case 'university':
        register.showElement(register.universityFieldset);
        register.hideElement(register.industryFieldset);
        register.hideElement(register.studyFieldset);

      default:
        register.hideElement(register.studyFieldset);
        register.hideElement(register.industryFieldset);
        register.showElement(register.universityFieldset);
        break;
    }
  },
  init: function init() {
    window.addEventListener('load', register.setFields(register.select.value));
    register.select.addEventListener('change', function (event) {
      register.setFields(event.target.value);
    });
  }
};

if (register.select !== null) {
  register.init();
} // const select = document.querySelector('#inputProgram')
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

/***/ }),

/***/ "./resources/js/components/_services.js":
/*!**********************************************!*\
  !*** ./resources/js/components/_services.js ***!
  \**********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_news__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/_news */ "./resources/js/components/_news.js");
/* harmony import */ var _main_breakpoints__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../main/breakpoints */ "./resources/js/main/breakpoints.js");


var services = {
  container: document.querySelector('.services'),
  init: function init() {
    window.addEventListener('load', services.setup);
    window.addEventListener('resize', services.setup);
  },
  setup: function setup(event) {
    services.setContainer(event);
  },
  setContainer: function setContainer(event) {
    if (_components_news__WEBPACK_IMPORTED_MODULE_0__["default"].polygon !== null) {
      var containerTopPosition = services.getContainerPosition();
      var main = $('main');
      var sections = $('main > section');
      Object.keys(sections).forEach(function (key) {
        if (parseInt(key) || key == 0) {
          if (event.type === 'load') {}
          /*$(sections[key]).css({
              'position': 'relative',
              'top': containerTopPosition * -1 + 'px',
          });*/

          /*if (event.type === 'resize') {
              $(sections[key]).css({
                  'top': containerTopPosition * -1 + 'px',
              });
          }*/

        }
      }); //services.fixPositionRelative(main, containerTopPosition);
    }
  },
  fixPositionRelative: function fixPositionRelative(element, displacedPosition, event) {
    $(element).height('auto');
    $(element).height($(element).height() - displacedPosition);
  },
  getContainerPosition: function getContainerPosition() {
    var percentage = _main_breakpoints__WEBPACK_IMPORTED_MODULE_1__["default"].isMediumDevice() ? 0.22 : 0.19;
    return _components_news__WEBPACK_IMPORTED_MODULE_0__["default"].polygon.clientHeight * percentage;
  }
};

if (services.container !== null) {
  services.init();
}

/***/ }),

/***/ "./resources/js/components/_single-offer.js":
/*!**************************************************!*\
  !*** ./resources/js/components/_single-offer.js ***!
  \**************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_dom__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../main/dom */ "./resources/js/main/dom.js");

var singleOffer = {
  init: function init() {
    window.addEventListener('load', singleOffer.setup);
  },
  currentViewport: window.innerWidth,
  currentScrollY: window.scrollY,
  setup: function setup(event) {
    singleOffer.setImages();
    window.addEventListener('resize', function () {
      singleOffer.currentViewport = singleOffer.getViewport();
    });
    document.querySelector('#jobDescription').innerHTML = singleOffer.showDescription(document.querySelector('#jobDescription').getAttribute('data-html'));
    singleOffer.toggleFixedButton(event);
    window.addEventListener('scroll', function (event) {
      singleOffer.currentScrollY = singleOffer.getScrollY();
      singleOffer.toggleFixedButton(event);
    });
  },
  setImages: function setImages() {
    var picture = singleOffer.getDataContent(document.querySelector('.card_background-image'));
    singleOffer.setProperty(document.querySelector('.card_background-image'), 'background-image', "url('".concat(picture, "')"));
  },
  getScrollY: function getScrollY() {
    return window.scrollY;
  },
  getViewport: function getViewport() {
    return window.innerWidth;
  },
  getDataContent: function getDataContent(element) {
    return $(element).attr('data-content');
  },
  setProperty: function setProperty(element, property, value) {
    element.style.setProperty(property, value);
  },
  toggleFixedButton: function toggleFixedButton(event) {
    var lastSection = $('.readable_section').last();
    var firstIndex = 0;
    ;
    var position = $(lastSection[firstIndex]).offset().top + lastSection[firstIndex].clientHeight;

    if (singleOffer.theViewportPassedOverHere(position)) {
      if (document.querySelector('.sendable_section--fixed')) {
        var applyNowButton = document.querySelector('.sendable_section--fixed');
        _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].toggleClass(applyNowButton, 'sendable_section--fixed', 'sendable_section');

        if (event.type === 'scroll') {
          position = window.scrollY + applyNowButton.clientHeight * 2;
          singleOffer.scrollTo(position);
        }
      }
    } else {
      if (document.querySelector('.sendable_section')) {
        var _applyNowButton = document.querySelector('.sendable_section');

        _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].toggleClass(_applyNowButton, 'sendable_section', 'sendable_section--fixed');
      }
    }
  },
  scrollTo: function scrollTo(position) {
    $("html").animate({
      'scrollTop': position
    }, 500, 'swing');
  },
  showDescription: function showDescription(inputDelta) {
    inputDelta = JSON.parse(inputDelta);
    var tempCont = document.createElement("div");
    new Quill(tempCont).setContents(inputDelta);
    return tempCont.getElementsByClassName("ql-editor")[0].innerHTML;
  },
  theViewportPassedOverHere: function theViewportPassedOverHere(y) {
    return window.pageYOffset + window.innerHeight >= y;
  }
};

if (document.querySelector('#job-description') !== null) {
  singleOffer.init();
}

/***/ }),

/***/ "./resources/js/components/_stats.js":
/*!*******************************************!*\
  !*** ./resources/js/components/_stats.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var stats = {
  init: function init() {
    $('.count').each(function () {
      $(this).prop('Counter', 0).animate({
        Counter: $(this).text()
      }, {
        duration: 4000,
        easing: 'swing',
        step: function step(now) {
          $(this).text(Math.ceil(now));
        }
      });
    });
  }
};

if (document.querySelector('.sensationalism-stats') !== null) {
  stats.init();
}

/***/ }),

/***/ "./resources/js/components/sliders.js":
/*!********************************************!*\
  !*** ./resources/js/components/sliders.js ***!
  \********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_dom__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../main/dom */ "./resources/js/main/dom.js");
/* harmony import */ var _main_breakpoints__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../main/breakpoints */ "./resources/js/main/breakpoints.js");


var press = {
  currentSlide: 0,
  carrousel: document.querySelector('.note_carrousel'),
  pictureHolder: document.querySelector('.note_window'),
  pictures: document.getElementsByClassName('slider_note'),
  tvSliderWidth: 0,
  tvLinks: document.querySelector('.tv') !== null ? document.querySelector('.tv').getElementsByTagName('a') : null,
  init: function init(event) {
    if (event.type !== 'resize') {
      press.setup();
    }

    $(press.pictures).width(press.pictureHolder.clientWidth);
    press.tvSliderWidth = press.getFirstChildWidth(press.pictures);
    console.log($(press.carrousel.width()));
    console.log("hola");
    $(press.carrousel).width(press.pictureHolder * press.pictures.length);

    if (event.type === 'resize') {
      press.update();
    }

    press.setSize(press.pictureHolder, 'height', press.pictures[0].offsetHeight);
  },
  setup: function setup() {
    press.tvSliderWidth = press.getFirstChildWidth(press.pictures); // Compatibility with all the browsers

    for (var i = 0; i < press.tvLinks.length; i++) {
      press.tvLinks[i].addEventListener('click', function (e) {
        e.preventDefault();
        var elementIndex = $(this).index();
        press.moveTo(elementIndex);
        press.noScroll();
      });
    }
  },
  update: function update() {
    var value = "translateX(".concat(press.tvSliderWidth * -press.currentSlide, "px)");
    _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].setProperty(press.carrousel, 'transform', value);
  },
  moveTo: function moveTo(elementIndex) {
    press.currentSlide = elementIndex + 1;
    var value = "translateX(".concat(press.tvSliderWidth * -press.currentSlide, "px)");
    _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].setProperty(press.carrousel, 'transform', value);
  },
  getFirstChildWidth: function getFirstChildWidth(element) {
    var indexFirstElement = 0;
    return element[indexFirstElement].offsetWidth;
  },
  setSize: function setSize(element, type, value) {
    element.style[type] = "".concat(value, "px");
  },
  noScroll: function noScroll() {
    window.scrollBy(0, 0);
  }
};
var courses = {
  currentSlide: 0,
  carrousel: document.querySelector('.description-container'),
  defaultSelectedCourse: 1,
  pictureHolder: document.querySelector('.course-descriptions'),
  pictures: document.getElementsByClassName('description-base'),
  courseLinks: document.querySelector('.description-options') !== null ? document.querySelector('.description-options').getElementsByTagName('a') : null,
  requestedCourseURL: null,
  init: function init(event) {
    courses.setup(event);

    if (_main_breakpoints__WEBPACK_IMPORTED_MODULE_1__["default"].widths.largeDevices[0] > window.innerWidth) {
      $(courses.pictures).width(courses.pictureHolder.clientWidth);
    }
  },
  setup: function setup(event) {
    courses.courseSliderWidth = courses.pictureHolder.clientWidth; // Sets the courses slider UI according to the current device used

    if (!_main_breakpoints__WEBPACK_IMPORTED_MODULE_1__["default"].isLargeDevice()) {
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
        courses.moveTo(courses.checkSelectedController() - 1); // Changes the background according to the slide requested in the server

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
      var _elementCount = courses.pictures.length; // Events arranged to the clickable elements in the courses slider

      var _loop = function _loop(i) {
        courses.pictures[i].addEventListener('click', function (e) {
          e.preventDefault();
          /*
           * Makes a GET request to the server ({ROOT_FOLDER}/learn/course=${course-number})
           * to retrieve the fitting information for each course displayed
           */

          if (courses.requestedCourseURL !== "/learn/course=".concat(i + 1)) {
            courses.requestedCourseURL = "/learn/course=".concat(i + 1);
            courses.getCourseInfo(courses.requestedCourseURL);
          }

          var elementIndex = $(this).index();
          courses.setDesktopSliders[i + 1]();
          courses.toggleControllers(elementIndex);
          courses.changeSliderBackground[elementIndex](courses.carrousel);
        });
      };

      for (var i = 0; i < _elementCount; i++) {
        _loop(i);
      } // Sets the course slider UI ready to be displayed in desktop devices


      courses.changeSliderBackground[courses.checkSelectedController() - 1](courses.carrousel);
      courses.setDesktopSliders[courses.checkSelectedController()]();
      courses.resetResponsiveSliders();
    }

    var elementCount = courses.courseLinks.length; // Events arranged to the slider controllers

    var _loop2 = function _loop2(i) {
      courses.courseLinks[i].addEventListener('click', function (e) {
        e.preventDefault();

        if (courses.requestedCourseURL !== "/learn/course=".concat(i + 1)) {
          courses.requestedCourseURL = "/learn/course=".concat(i + 1);
          courses.getCourseInfo(courses.requestedCourseURL);
        }

        var elementIndex = $(this).index();

        if (!_main_breakpoints__WEBPACK_IMPORTED_MODULE_1__["default"].isLargeDevice()) {
          courses.moveTo(elementIndex);
        } else {
          courses.setDesktopSliders[i + 1]();
        }

        if (!$(this).hasClass('selected')) {
          courses.toggleControllers(elementIndex);
          courses.changeSliderBackground[elementIndex](courses.carrousel);
        }
      });
    };

    for (var i = 0; i < elementCount; i++) {
      _loop2(i);
    }
  },
  getCourseInfo: function getCourseInfo(path) {
    var data = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
    $.get({
      url: path,
      cache: false,
      data: data,
      dataType: 'html',
      error: function error(xhr, status, _error) {
        console.log(_error);
      },
      success: function success(data, status, xhr) {
        $('.course-information').remove();
        $('.course-descriptions').after(data);
      }
    });
  },
  addTransition: function addTransition() {
    courses.carrousel.classList.add('transition');
  },
  resetResponsiveSliders: function resetResponsiveSliders() {
    _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].setProperty(courses.carrousel, 'transform', 'translate(0px)');
  },
  keepSliderPositionWhenResponsive: function keepSliderPositionWhenResponsive() {
    return courses.currentSlide === 0 ? 0 : courses.courseSliderWidth;
  },
  resetDesktopSliders: function resetDesktopSliders() {
    for (var i = 0; i < courses.pictures.length; i++) {
      $(courses.pictures[i]).attr('class', 'description-base');
    }
  },
  setDesktopSliders: {
    1: function _() {
      courses.currentSlide = 0;

      if (document.querySelector('.left-slide') === null) {
        _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].toggleSingleClass(courses.pictures[courses.currentSlide], 'left-slide');
      }

      if (document.querySelector('.left-slide--none') !== null) {
        _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].toggleSingleClass(courses.pictures[courses.currentSlide], 'left-slide--none');
      }

      if (document.querySelector('.right-slide') !== null) {
        _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].toggleSingleClass(courses.pictures[courses.currentSlide + 1], 'right-slide');
      }

      if (document.querySelector('.right-slide--none') === null) {
        _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].toggleSingleClass(courses.pictures[courses.currentSlide + 1], 'right-slide--none');
      }
    },
    2: function _() {
      courses.currentSlide = 1;

      if (document.querySelector('.right-slide') === null) {
        _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].toggleSingleClass(courses.pictures[courses.currentSlide], 'right-slide');
      }

      if (document.querySelector('.right-slide--none') !== null) {
        _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].toggleSingleClass(courses.pictures[courses.currentSlide], 'right-slide--none');
      }

      if (document.querySelector('.left-slide') !== null) {
        _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].toggleSingleClass(courses.pictures[courses.currentSlide - 1], 'left-slide');
      }

      if (document.querySelector('.left-slide--none') === null) {
        _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].toggleSingleClass(courses.pictures[courses.currentSlide - 1], 'left-slide--none');
      }
    }
  },
  checkSelectedController: function checkSelectedController() {
    var controllerSelected = courses.defaultSelectedCourse;
    var elementsCount = courses.courseLinks.length;

    for (var i = 0; i < elementsCount; i++) {
      if ($(courses.courseLinks[i]).hasClass('selected')) {
        controllerSelected = i + 1;
      }
    }

    return controllerSelected;
  },
  update: function update() {
    var value = 'translateX(' + 50 * -courses.currentSlide + '%)';
    _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].setProperty(courses.carrousel, 'transform', value);
  },
  toggleControllers: function toggleControllers(selectedController) {
    _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].toggleSingleClass($('.description-options > .selected'), 'selected');
    _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].toggleSingleClass($(courses.courseLinks[selectedController]), 'selected');
  },
  changeSliderBackground: [function (element) {
    _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].setProperty(element, 'background', '#000000');
  }, function (element) {
    _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].setProperty(element, 'background', '#C80B0B');
  }],
  setSize: function setSize(element, type, value) {
    element.style[type] = "".concat(value, "px");
  },
  courseSliderWidth: 0,
  getFirstChildWidth: function getFirstChildWidth(element) {
    var indexFirstElement = 0;
    return element[indexFirstElement].offsetWidth;
  },
  moveTo: function moveTo(elementIndex) {
    courses.currentSlide = elementIndex;
    var value = 'translateX(' + 50 * -courses.currentSlide + '%)';
    _main_dom__WEBPACK_IMPORTED_MODULE_0__["default"].setProperty(courses.carrousel, 'transform', value);
  }
};

if (document.querySelector('.note_carrousel') !== null) {
  $(document).ready(press.init);
  $(window).resize(press.init);
}

if (document.querySelector('.course-descriptions') !== null) {
  window.addEventListener('load', courses.init);
  $(window).resize(courses.init);
}

/***/ }),

/***/ "./resources/js/main/ajax.js":
/*!***********************************!*\
  !*** ./resources/js/main/ajax.js ***!
  \***********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var ajax = {
  setAjax: function setAjax() {
    try {
      return new XMLHttpRequest();
    } catch (e) {
      try {
        return new ActiveXObject("Msxml12.XMLHTTP");
      } catch (e) {
        try {
          return new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {
          alert("Your browser can't support a picture preview");
          return false;
        }
      }
    }
  }
};
/* harmony default export */ __webpack_exports__["default"] = (ajax);

/***/ }),

/***/ "./resources/js/main/breakpoints.js":
/*!******************************************!*\
  !*** ./resources/js/main/breakpoints.js ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var breakpoints = {
  heights: {
    smallDevices: 156,
    mediumDevices: 146,
    largeDevices: 100
  },
  widths: {
    smallDevices: [0, 680],
    customerJourney: [0, 460],
    mediumDevices: [681, 992],
    largeDevices: [993]
  },
  isLargeDevice: function isLargeDevice() {
    return window.innerWidth >= breakpoints.widths.largeDevices[0];
  },
  isMediumDevice: function isMediumDevice() {
    return window.innerWidth >= breakpoints.widths.mediumDevices[0] && window.innerWidth < breakpoints.widths.mediumDevices[1];
  },
  isSmallDevice: function isSmallDevice() {
    return window.innerWidth >= 0 && window.innerWidth < breakpoints.widths.smallDevices[1];
  },
  isCustomerJourney: function isCustomerJourney() {
    return window.innerWidth >= 0 && window.innerWidth < breakpoints.widths.customerJourney[1];
  }
};
/* harmony default export */ __webpack_exports__["default"] = (breakpoints);

/***/ }),

/***/ "./resources/js/main/dom.js":
/*!**********************************!*\
  !*** ./resources/js/main/dom.js ***!
  \**********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var dom = {
  setProperty: function setProperty(element, property, value) {
    element.style[property] = value;
  },
  getProperty: function getProperty(element, property) {
    return element.style.getPropertyValue(property);
  },
  resetProperty: function resetProperty(element, property) {
    element.style[property] = '';
  },
  toggleClass: function toggleClass(element, firstClassName, secondClassName) {
    $(element).toggleClass(firstClassName);
    $(element).toggleClass(secondClassName);
  },
  removeSingleClass: function removeSingleClass(element, className) {
    $(element).removeClass(className);
  },
  toggleSingleClass: function toggleSingleClass(element, className) {
    $(element).toggleClass(className);
  },
  expandToViewport: function expandToViewport(element) {
    $(element).width(document.body.clientWidth);
  },
  getHighestElement: function getHighestElement(elements) {
    var elementsHeight = [];

    for (var i = 0; i < elements.length; i++) {
      elementsHeight.push(elements[i].clientHeight);
    }

    return elements[elementsHeight.indexOf(Math.max.apply(null, elementsHeight))];
  }
};
/* harmony default export */ __webpack_exports__["default"] = (dom);

/***/ }),

/***/ "./resources/js/main/env.js":
/*!**********************************!*\
  !*** ./resources/js/main/env.js ***!
  \**********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var env = {
  paths: {
    "public": '/../../'
  }
};
/* harmony default export */ __webpack_exports__["default"] = (env);

/***/ }),

/***/ "./resources/js/main/messages.js":
/*!***************************************!*\
  !*** ./resources/js/main/messages.js ***!
  \***************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var messages = {
  form: {
    labels: [],
    inputs: [],
    errors: [],
    advices: {
      removeOffer: function removeOffer(value) {
        return "Are you sure you want to remove permanently ".concat(value, " offer?");
      }
    }
  }
};
/* harmony default export */ __webpack_exports__["default"] = (messages);

/***/ }),

/***/ "./resources/sass/main.scss":
/*!**********************************!*\
  !*** ./resources/sass/main.scss ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/components/sliders.js ./resources/js/components/_register.js ./resources/js/components/_nav.js ./resources/js/components/_page-title.js ./resources/js/components/_offers.js ./resources/js/components/_offers-list.js ./resources/js/components/_single-offer.js ./resources/js/components/_edit-offer.js ./resources/js/components/_news.js ./resources/js/components/_services.js ./resources/js/components/_chinese-courses.js ./resources/js/components/_customer-journey.js ./resources/js/components/_filter-by.js ./resources/js/components/_stats.js ./resources/js/components/_motifs.js ./resources/js/components/_footer.js ./resources/sass/main.scss ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\sliders.js */"./resources/js/components/sliders.js");
__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\_register.js */"./resources/js/components/_register.js");
__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\_nav.js */"./resources/js/components/_nav.js");
__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\_page-title.js */"./resources/js/components/_page-title.js");
__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\_offers.js */"./resources/js/components/_offers.js");
__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\_offers-list.js */"./resources/js/components/_offers-list.js");
__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\_single-offer.js */"./resources/js/components/_single-offer.js");
__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\_edit-offer.js */"./resources/js/components/_edit-offer.js");
__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\_news.js */"./resources/js/components/_news.js");
__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\_services.js */"./resources/js/components/_services.js");
__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\_chinese-courses.js */"./resources/js/components/_chinese-courses.js");
__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\_customer-journey.js */"./resources/js/components/_customer-journey.js");
__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\_filter-by.js */"./resources/js/components/_filter-by.js");
__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\_stats.js */"./resources/js/components/_stats.js");
__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\_motifs.js */"./resources/js/components/_motifs.js");
__webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\js\components\_footer.js */"./resources/js/components/_footer.js");
module.exports = __webpack_require__(/*! E:\Salva\Proyectos\XAMPP\intuuchina\resources\sass\main.scss */"./resources/sass/main.scss");


/***/ })

/******/ });