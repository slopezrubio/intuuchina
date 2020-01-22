import { SliderFactory } from '../factories/SliderFactory';
import UI from '../main/UI';

function PeopleSlider(options) {
    this.holder = document.querySelector('.people-slider__holder');
    this.offset = 1;
    this.interval = options.interval;
    this.duration = options.duration;
    this.currentSlideIndex = options.slide ? options.slide + this.offset : 1;
    this.carousel = this.holder.children[0];
    this.slides = this.carousel.children;
    this.currentSlide = this.currentSlide = this.slides[this.currentSlideIndex - this.offset];

    this.init = function() {
        //setInterval(this.renew, this.interval);
        setInterval(() => {
            this.renew(this);
        }, this.interval);
    };

    this.setCurrentSlide = function(value) {
        this.currentSlide = this.slides[value - this.offset];
        return this;
    };

    this.setCurrentSlideIndex = function(value = null) {
        this.currentSlideIndex = value;
        return this;
    };

    this.isCurrentSlideIndex = function(value) {
        return value === this.currentSlideIndex;
    };

    this.renew = function(self = this) {
        let randomSlideIndex = Math.floor(Math.random() * this.slides.length) + this.offset;
        if (!this.isCurrentSlideIndex(randomSlideIndex)) {
            self.setCurrentSlideIndex(randomSlideIndex)
                .setCurrentSlide(this.currentSlideIndex)
                .moveCarousel()
                .fade('out')
                .fade('in');
        }
    };

    this.fade = function(type) {
        let fn = 'fade' + UI.upperCaseFirst(type);

        $(this.carousel)[fn]({
            duration: this.duration,
            easing: 'swing',
        });

        return this;
    };

    this.moveCarousel = function() {
        let posY = this.holder.clientHeight * (this.currentSlideIndex - this.offset);

        $(this.carousel).css({
            "-webkit-transform": "translateY(-" + posY + "px)",
            "transform": "translateY(-" + posY + "px)",
            "-ms-transform": "translateY(-" + posY + "px)",
            "-o-transform": "translateY(-" + posY + "px)",
        });

        return this;
    };

    this.init();
}

export var peopleSliderFactory = new SliderFactory();

export default PeopleSlider;