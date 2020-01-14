import DOM from '../main/dom';

if (document.querySelector('header#register') !== null) {

  var registerForm = (function() {

    var _fieldsets = {
      industry: document.querySelector('#industryFieldset'),
      study: document.querySelector('#studyFieldset'),
      program: document.querySelector('#programFieldset'),
      university: document.querySelector('#universityFieldset'),
      cv: $('#cv').parents('.form-group')[0],
    }

    var _inputs = {
      program: document.querySelector('#inputProgram'),
    }

    function init() {
      window.addEventListener('load', setFields);

      _inputs.program.addEventListener('change', setFields);
    }

    function getProgramSelected() {
      return _inputs.program.options[_inputs.program.selectedIndex].value;
    }

    function setFields() {
      switch (getProgramSelected()) {
        case 'internship':
        case 'inter_relocat':
          DOM.show(_fieldsets.cv);
          DOM.show(_fieldsets.industry);
          DOM.hide(_fieldsets.university);
          DOM.hide(_fieldsets.study);
          break;
        case 'study':
          DOM.hide(_fieldsets.cv);
          DOM.hide(_fieldsets.industry);
          DOM.hide(_fieldsets.university);
          DOM.show(_fieldsets.study);
          break;
        case 'university':
          DOM.show(_fieldsets.cv);
          DOM.hide(_fieldsets.industry);
          DOM.show(_fieldsets.university);
          DOM.hide(_fieldsets.study);
          break;
      }
    }

    init();
  })()
}




