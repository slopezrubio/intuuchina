import ArrowSlider from '../components/ArrowSlider';
import MediaSlider from '../components/MediaSlider';
import PeopleSlider from '../components/PeopleSlider';

export function SliderFactory() {}

SliderFactory.prototype.sliderClass = ArrowSlider;

SliderFactory.prototype.createSlider = function(options) {
    switch(options.type) {
        case 'arrow':
            this.sliderClass = ArrowSlider;
            break;
        case 'media':
            this.sliderClass = MediaSlider;
            break;
        case 'people':
            this.sliderClass = PeopleSlider;
            break;
    }

    return new this.sliderClass(options);
};