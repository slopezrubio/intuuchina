import ArrowSlider from '../components/ArrowSlider';
import MediaSlider from '../components/MediaSlider';

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
    }

    return new this.sliderClass(options);
};