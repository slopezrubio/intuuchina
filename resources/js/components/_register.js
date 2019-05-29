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
      register.hideElement(industryFieldset)
    }

    if (register.studyFieldset) {
      register.hideElement(studyFieldset)
    }

    if (register.universityFieldset) {
      register.hideElement(universityFieldset)
    }
  },
  init: () => {
    window.addEventListener('load', register.checkFields)
    register.select.addEventListener('change', event => {
      const currentValue = event.target.value

      switch (currentValue) {
        case 'intership':
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
        case 'universty':
          register.showElement(register.universityFieldset)
          register.hideElement(register.industryFieldset)
          register.hideElement(register.studyFieldset)
        default:
          register.hideElement(register.studyFieldset)
          register.hideElement(register.industryFieldset)
          register.hideElement(register.universityFieldset)
          break
      }
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




