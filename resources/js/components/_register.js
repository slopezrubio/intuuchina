const select = document.querySelector('#inputProgram')
const industryFieldset = document.querySelector('#industryFieldset')
const studyFieldset = document.querySelector('#studyFieldset')
const universityFieldset = document.querySelector('#universityFieldset')

const showElement = (domElement) => {
  domElement.classList.remove('hidden')
  domElement.setAttribute('aria-hidden', false)
}

const hideElement = (domElement) => {
  domElement.classList.add('hidden')
  domElement.setAttribute('aria-hidden', true)
}

if (industryFieldset) {
  hideElement(industryFieldset)
}
if (studyFieldset) {
  hideElement(studyFieldset)
}

if (universityFieldset) {
  hideElement(universityFieldset)
}

select.addEventListener('change', event => {
  const currentValue = event.target.value

  switch (currentValue) {
    case 'intership':
    case 'inter_relocat':
    case 'inter_housing':
      showElement(industryFieldset)
      hideElement(studyFieldset)
      hideElement(universityFieldset)
      break
    case 'study':
      showElement(studyFieldset)
      hideElement(industryFieldset)
      hideElement(universityFieldset)
      break
    case 'universty':
    showElement(universityFieldset)
    hideElement(industryFieldset)
    hideElement(studyFieldset)
    default:
      hideElement(studyFieldset)
      hideElement(industryFieldset)
      hideElement(universityFieldset)
      break
  }
})
