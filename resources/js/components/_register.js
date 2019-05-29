const select = document.querySelector('select[name="program"]')
const industryFieldset = document.querySelector('fieldset[name="industry"]')
const studyFieldset = document.querySelector('fieldset[name="study"]')

const showElement = domElement => {
  domElement.classList.remove('hidden')
  domElement.setAttribute('aria-hidden', false)
}

const hideElement = domElement => {
  domElement.classList.add('hidden')
  domElement.setAttribute('aria-hidden', true)
}

if (industryFieldset) {
  hideElement(industryFieldset)
}
if (studyFieldset) {
  hideElement(studyFieldset)
}

select.addEventListener('change', event => {
  // console.log(event.target.value)
  const currentValue = event.target.value

  switch (currentValue) {
    case '1':
      showElement(industryFieldset)
      hideElement(studyFieldset)
      break
    case '2':
      showElement(studyFieldset)
      hideElement(industryFieldset)
      break
    default:
      hideElement(studyFieldset)
      hideElement(industryFieldset)
      break
  }
})
