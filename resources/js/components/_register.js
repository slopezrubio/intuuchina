let register = {
  select: document.querySelector('#inputProgram'),
  industryFieldset: document.querySelector('#industryFieldset'),
  studyFieldset: document.querySelector('#studyFieldset'),
  universityFieldset: document.querySelector('#universityFieldset'),
  cvFieldset: $('#cv').parents('.form-group')[0],
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
  setFields: (selectorValue) => {
    switch (selectorValue) {
      case 'internship':
      case 'inter_relocat':
        register.showElement(register.cvFieldset);
        register.showElement(register.industryFieldset);
        register.hideElement(register.studyFieldset);
        register.hideElement(register.universityFieldset);
        break;
      case 'study':
        register.showElement(register.studyFieldset);
        register.hideElement(register.industryFieldset);
        register.hideElement(register.universityFieldset);
        register.hideElement(register.cvFieldset);
        break;
      case 'university':
        register.showElement(register.cvFieldset);
        register.showElement(register.universityFieldset);
        register.hideElement(register.industryFieldset);
        register.hideElement(register.studyFieldset);
      default:
        register.showElement(register.cvFieldset);
        register.hideElement(register.studyFieldset);
        register.hideElement(register.industryFieldset);
        register.showElement(register.universityFieldset);
        break;
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




