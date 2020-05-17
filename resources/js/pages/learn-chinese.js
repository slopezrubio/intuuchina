import { arrowSliderFactory } from "../components/ArrowSlider";
import {bottomNavigationFactory} from "../components/BottomNavigation";

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        if (document.querySelector('main#learn-chinese') !== null) {
            var learnChineseSlider = arrowSliderFactory.createSlider({
                type: 'arrow',
                sections: ['in-person', 'online'],
                callbacks:  {
                    controllers: function(slider) {
                        console.log(slider);
                    }
                }
            });
        }
    });
})()