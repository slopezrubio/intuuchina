import DOM from './dom';
import MediaQueries from './breakpoints';

var UI = (function() {
    var instance;

    function init() {
        // Private properties
        var patterns = {
            verticalCustomerJourney: /vertical.(png|jpg|gif)$/g,
            horizontalCustomerJourney: /horizontal.(png|jpg|gif)$/g
        }

        // Private methods

        return {
            get: function(key) {
                return eval(key);
            },

            getPattern: function(name) {
                return patterns[name];
            },

            getLocale: function() {
                return document.querySelector('html').getAttribute('lang');
            },

            getCustomerJourneyPicture: function(customerJourney) {
                if (MediaQueries.isCustomerJourney() && !$(customerJourney).hasClass('customer-journey')) {
                    DOM.toggleSingleClass(customerJourney, 'customer-journey--mobile');
                    return {
                        className: 'customer-journey',
                        src: 'horizontal'
                    };
                }

                if (!MediaQueries.isCustomerJourney() && !$(customerJourney).hasClass('customer-journey--mobile')) {
                    DOM.toggleSingleClass(customerJourney, 'customer-journey');
                    return {
                        className: 'customer-journey--mobile',
                        src: 'vertical'
                    };
                }

                return null;
            },

            upperCaseFirst: function(string) {
                let indexSecondCharacter = 1;

                return string.toUpperCase().charAt(0) + string.slice(indexSecondCharacter, (string.length));
            },

            getInputClass: function(input) {

                if ($(input).has('.switch')) {
                    if (MediaQueries.isLargeDevice() && !$(input).hasClass('checkbox_input')) {
                        return 'checkbox_input';
                    }

                    if (!MediaQueries.isLargeDevice() && !$(input).hasClass('switch_input')) {
                        return 'switch_input';
                    }

                    return null;
                };
                // if (MediaQueries.isLargeDevice()) {
                //
                //     // Transforms the switch input into a checkbox
                //     if (!$(input).hasClass('switch_input')) {
                //         DOM.toggleClass(input,'switch_input', 'checkbox_input');
                //     }
                //
                // } else {
                //     console.log($(input).hasClass('switch_input'));
                //
                //     // Transforms the checkbox input into a switch button
                //     if ($(input).hasClass('checkbox_input')) {
                //         DOM.toggleClass(input, 'switch_input', 'checkbox_input');
                //     }
                //
                // }
            },

            toggleSpinnerButtonState: function(button) {
                let spinner = button.querySelector('.spinner-border');

                if (spinner !== null) {
                    $(spinner).hasClass('hidden') ? spinner.classList.remove('hidden') : spinner.classList.add('hidden');

                    if (!$(spinner).hasClass('hidden')) {
                        spinner.parentElement.previousElementSibling.style.display = "none";
                        spinner.parentElement.style.display = "block";
                    } else {
                        spinner.parentElement.previousElementSibling.style.display = "block";
                        spinner.parentElement.style.display = "none";
                    }
                }
            },

            // Sets the loader in the submit button of the given form.
            changeLoadingButtonState: function(form) {
                if (form.querySelector('.spinner-border') !== null) {
                    let spinner = form.querySelector('.spinner-border');
                    $(spinner).hasClass('hidden') ? spinner.classList.remove('hidden') : spinner.classList.add('hidden');

                    if (!$(spinner).hasClass('hidden')) {
                        spinner.parentElement.previousElementSibling.style.display = "none";
                        spinner.parentElement.style.display = "block";
                    } else {
                        spinner.parentElement.previousElementSibling.style.display = "block";
                        spinner.parentElement.style.display = "none";
                    }

                    return true;
                }

                return false;
            }
        };
    }

    return {
        getInstance: function() {
            if (!instance) {
                instance = init();
            }

            return instance;
        }
    }

})();

export default UI.getInstance();

