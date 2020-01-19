import { SliderFactory } from "../factories/SliderFactory";

function MediaSlider(options) {
    this.holder = document.querySelector('.note_window');
    this.offset = 1;
    this.currentSlideIndex = null;
    this.carousel = this.holder.children[0];
    this.slides = this.carousel.children;
    this.controllers = document.querySelector('.tv').children;
    this.currentSlide = this.slides[0];

    this.init = function() {
        this.setControllersListeners()
            .setCurrentSlideIndex()
            .setCurrentSlide(this.currentSlideIndex)
            .setWidths()
            .setHolder();

        this.listeners();
    };

    /**
     * Sets the slider holder height to the same value as the
     * highest slide of the slider.
     */
    this.setHolder = function() {
        this.holder.style.height = this.getSlidesHeight();
    };

    /**
     * Sets all the listeners of the slider.
     */
    this.listeners = function() {
        window.addEventListener('resize', () => {
            this.update(this);
        });
    };

    /**
     * Makes the proper settings to fit the slider according
     * to the browser's viewport.
     *
     * @returns {MediaSlider}
     */
    this.setWidths = function() {
        this.carousel.style.width = $(this.holder).width() * this.slides.length + 'px';
        $(this.slides).width(this.holder.clientWidth);
        return this;
    };

    this.setCurrentSlideIndex = function(value = null) {
        if (value == null) {
            this.currentSlideIndex = 0;
            return this;
        }

        this.currentSlideIndex = value;
        return this;
    };

    /**
     * Updates the slider controllers according to the slide selected by the user..
     *
     * @param self
     */
    this.update = function(self = this) {
        self.moveCarousel();
        return this;
    };

    this.setCurrentSlide = function(value) {
        this.currentSlide = this.slides[value];
        return this;
    };

    this.setControllersListeners = function() {
        for (let i = 0; i < this.controllers.length; i++) {
            this.controllers[i].addEventListener('click', (e) => {
                e.preventDefault();
                this.preventScrolling()
                    .setCurrentSlideIndex(i + this.offset)
                    .setCurrentSlide(this.setCurrentSlideIndex)
                    .moveCarousel();
            })
        }

        return this;
    };

    this.getSlidesWidth = function() {
        return $(this.slides[0]).width();
    };

    this.getSlidesHeight = function() {
        return this.slides[0].offsetHeight;
    };

    this.preventScrolling = function() {
        window.scrollBy(0,0);
        return this;
    };

    /**
     * Slide the slider toward the one selected by the user.
     *
     * @returns {ArrowSlider}
     */
    this.moveCarousel = function() {
        $(this.carousel).css({
            "-webkit-transform": "translateX(-" + (this.holder.clientWidth * (this.currentSlideIndex)) + "px)",
            "transform": "translateX(-" + (this.holder.clientWidth * (this.currentSlideIndex)) + "px)",
            "-ms-transform": "translateX(-" + (this.holder.clientWidth * (this.currentSlideIndex)) + "px)",
            "-o-transform": "translateX(-" + (this.holder.clientWidth * (this.currentSlideIndex)) + "px)",
        });

        return this;
    }

    this.init();
}

export var mediaSliderFactory = new SliderFactory();

export default MediaSlider;