import { arrowSliderFactory } from "../components/ArrowSlider";

import api from '../main/api';

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        if (document.querySelector('main#learn-chinese') !== null) {
            var learnChineseSlider = arrowSliderFactory.createSlider({
                type: 'arrow',
                sections: ['in-person', 'online'],
                callbacks:  {
                    controllers: function(slider) {
                        let category = slider.querySelector('input[name=category]').value;
                        api.getCourseInfo(category, replaceCategoryInfoBox)
                    }
                }
            });

            var replaceCategoryInfoBox = function(newSection) {
                let section = $('section#course-info');

                $(section).children('.c-price-box')[0].remove();
                $(section).append(newSection);
            }
        }
    });
})()