import MediaQueries from '../main/breakpoints';
import DOM from '../main/dom';
import { SliderFactory } from '../factories/SliderFactory';

function ArrowSlider(options) {
    this.holder = document.querySelector('.arrow-slider__holder');
    this.offset = 1;
    this.currentSlideIndex = options.slide ? options.slide + this.offset : null;
    this.carousel = this.holder.children[0];
    this.slides = this.carousel.children;
    this.controllers = [];
    this.controllersCallback = options.controllersCallback ? options.controllersCallback : null;
    this.currentSlide = this.slides[this.currentSlideIndex - this.offset];

    this.init = function() {
        this.setControllers()
            .setColors()
            .setCurrentSlideIndex()
            .setCurrentSlide(this.currentSlideIndex - this.offset)
            .runAutoWidths()
            .setResponsive();

        this.setListeners();
    };

    /**
     * Sets all the listeners.
     */
    this.setListeners = function() {
        window.addEventListener('resize', () => {
            this.setResponsive(this);
        });
    };

    /**
     * Sets an array of the colors used by each slide of the slider.
     *
     * @returns {ArrowSlider}
     */
    this.setColors = function() {
        this.colors = [];
        for (let i = 0; i < this.slides.length; i++) {
            this.colors.push(window.getComputedStyle(this.slides[i], ':before').getPropertyValue('background-color'));
        }

        return this;
    };

    /**
     * Sets the corresponding width for the given slide.
     *
     * @param slide
     * @returns {ArrowSlider}
     */
    this.autoWidth = function(slide) {
        /*
         * Gives the slide passed the same width as the holder has
         * so that each slide fit the width of the viewport.
         */
        $(slide).width(this.holder.clientWidth);

        // If is not a mobile device
        if (MediaQueries.isLargeDevice()) {

            /*
             * If the slide passed is the current the user is interacting with
             * sets the proper class to the element.
             */
            if (this.isCurrentSlide(slide)) {
                $(slide).removeClass();
                DOM.toggleSingleClass(slide, 'arrow-slider__slide--current');

                /**
                 * Additionally, checks if the current slide is the first or the last
                 * as well, thus the text doesn't get centered.
                 */
                if (this.isFirstSlide(slide)) {
                    DOM.toggleSingleClass(slide, 'first');
                }

                if (this.isLastSlide(slide)) {
                    DOM.toggleSingleClass(slide, 'last');
                }
            }

            /*
             * If the slide passed is the previous to the one the user
             * is interacting with, then sets the proper class to the element.
             */
            if (this.isPreviousSlide(slide)) {
                $(slide).removeClass();
                DOM.toggleSingleClass(slide, 'arrow-slider__slide--left');
            }

            /*
             * If the slide passed is the next to the one the user
             * is interacting with, then sets the proper class to the element.
             */
            if (this.isNextSlide(slide)) {
                $(slide).removeClass();
                DOM.toggleSingleClass(slide, 'arrow-slider__slide--right');
            }

            return this;
        }

        /**
         * Ultimately, sets the same class as used when the user
         * is using a mobile device.
         */
        $(slide).removeClass();
        DOM.toggleSingleClass(slide, 'arrow-slider__slide');
        return this;
    };

    this.isCurrentSlide = function(slide) {
        if (this.currentSlide !== undefined) {
            return slide.isEqualNode(this.currentSlide);
        }

        return false;
    };

    this.isNextSlide = function(slide) {
        if (this.slides[this.currentSlideIndex] !== undefined) {
            return slide.isEqualNode(this.slides[this.currentSlideIndex]);
        }
        return false;
    };

    this.getNextSlide = function() {
        if (this.slides[this.currentSlideIndex] !== undefined) {
            return this.slides[this.currentSlideIndex];
        }

        return null;
    };

    this.getCurrentSlide = function() {
        if (this.slides[this.currentSlideIndex - this.offset] !== undefined) {
            return this.slides[this.currentSlideIndex - this.offset];
        }

        return null;
    };

    this.getPreviousSlide = function() {
        if (this.slides[this.currentSlideIndex - (this.offset * 2)] !== undefined) {
            return this.slides[this.currentSlideIndex - (this.offset * 2)];
        }

        return null;
    };

    this.isPreviousSlide = function(slide) {
        if (this.slides[this.currentSlideIndex - (this.offset * 2)] !== undefined) {
            return slide.isEqualNode(this.slides[this.currentSlideIndex - (this.offset * 2)]);
        }

        return false;
    };

    this.isFirstSlide = function(slide) {
        return slide.isEqualNode(this.slides[0]);
    };

    this.isLastSlide = function(slide) {
        return slide.isEqualNode(this.slides[this.slides.length - this.offset]);
    };

    this.setCurrentSlide = function(value) {
        this.currentSlide = this.slides[value];
        return this;
    };

    this.setCurrentSlideIndex = function(value = null) {
        if (value === null) {
            for (let i = 0; i < this.controllers.length; i++) {
                if ($(this.controllers[i]).hasClass('selected')) {
                    this.currentSlideIndex = i + this.offset;
                    return this;
                }
            }
        }

        this.currentSlideIndex = value + this.offset;
        return this;
    };

    /**
     * Sets the width of all the slides comprised in the slider.
     *
     * @returns {ArrowSlider}
     */
    this.runAutoWidths = function() {
        for (let i = 0; i < this.slides.length; i++) {
            this.autoWidth(this.slides[i]);
        };

        return this;
    };

    /**
     * Makes the proper settings to fit the slider according
     * to the browser's viewport.
     *
     * @param self
     */
    this.setResponsive = function(self = this) {
        self.setControllers();

        // Sets the slider holder width.
        $(self.carousel).width(self.holder.clientWidth * self.slides.length);

        self.runAutoWidths()
            .moveCarousel()
            .paint();
    };

    this.isLightColor = function(color) {
        let lightColorsCounter = 0;

        for(let i = 0; i < 'rgb'.length; i++) {
            if (parseInt(color.match(/[0-9]{1,3}/g)[i]) > 150) {
                lightColorsCounter++;
            }
        }

        return lightColorsCounter >= 2;
    };

    /**
     * Sets the corresponding colour of the current slide and its controllers.
     *
     * @returns {ArrowSlider}
     */
    this.paint = function() {
        // Change carousel background to the proper color given
        this.carousel.style.background = this.colors[this.currentSlideIndex - this.offset];

        let controllersContainer = this.controllers[this.currentSlideIndex - this.offset].parentElement;

        if (this.isLightColor(this.carousel.style.backgroundColor)) {
            if (!$(controllersContainer).hasClass('dark')) {
                DOM.toggleSingleClass(controllersContainer, 'dark');
            }
            return this;
        }

        if ($(controllersContainer).hasClass('dark')) {
            DOM.toggleSingleClass(controllersContainer, 'dark');
        }

        return this;
    };

    /**
     * Slide the slider toward the one selected by the user.
     *
     * @returns {ArrowSlider}
     */
    this.moveCarousel = function() {
        $(this.carousel).css({
            "-webkit-transform": "translateX(-" + (this.holder.clientWidth * (this.currentSlideIndex - this.offset)) + "px)",
            "transform": "translateX(-" + (this.holder.clientWidth * (this.currentSlideIndex - this.offset)) + "px)",
            "-ms-transform": "translateX(-" + (this.holder.clientWidth * (this.currentSlideIndex - this.offset)) + "px)",
            "-o-transform": "translateX(-" + (this.holder.clientWidth * (this.currentSlideIndex - this.offset)) + "px)",
        });

        return this;
    };

    /**
     * Updates the slider controllers according to the slide selected by the user.
     * (e.g. If the user selects the second slide, then the controller bound to that
     * slide gets marked and the next and previous slide change).
     *
     * @param e
     */
    this.updateController = (e) => {
        e.preventDefault();

        for (let x = 0; x < this.controllers.length; x++) {
            if (e.target.isEqualNode(this.controllers[x]) || e.target.parentElement.isEqualNode(this.controllers[x])) {
                if (this.currentSlideIndex !== x + this.offset) {
                    // Update controllers.
                    DOM.toggleSingleClass(this.controllers[this.currentSlideIndex - this.offset], 'selected');
                    if (x >= this.slides.length) {
                        let slideSelected = this.isNextSlide(this.controllers[x]) === true ? this.currentSlideIndex : this.currentSlideIndex - (this.offset * 2);
                        this.setCurrentSlide(slideSelected)
                            .setCurrentSlideIndex(slideSelected);
                    } else {
                        this.setCurrentSlideIndex(x)
                            .setCurrentSlide(x);
                    }

                    DOM.toggleSingleClass(this.controllers[this.currentSlideIndex - this.offset], 'selected');

                    // Update the sliders.
                    this.runAutoWidths()
                        .moveCarousel()
                        .paint();

                    if (this.controllersCallback !== null) {
                        this.controllersCallback(this.currentSlide);
                    }

                    this.setControllers();
                }
            }
        }
    };

    /**
     * Attaches the events bound to the slider controllers.
     */
    this.setControllersListeners = function() {
        for (let i = 0; i < this.controllers.length; i++) {
            this.controllers[i].removeEventListener('click', this.updateController);
            this.controllers[i].addEventListener('click', this.updateController);
        }
    };

    /**
     * Restart all the controllers of the slider.
     *
     * @return {ArrowSlider}
     */
    this.resetControllers = function() {
        if (this.slides.length < this.controllers.length) {
            for (let i = this.slides.length; i < this.controllers.length; i++) {
                this.controllers.pop();
            }
        }

        return this;
    };

    /**
     * Set the controllers of the slider and attaches their corresponding events.
     *
     * @returns {ArrowSlider}
     */
    this.setControllers = function() {
        if (!this.controllers.length > 0) {
            let controllers = document.querySelector('.arrow-slider__controllers').children;

            for (let i = 0; i < controllers.length; i++) {
                this.controllers.push(controllers[i]);
            }
        }

        if (this.currentSlideIndex !== null) {
            this.resetControllers();

            if (MediaQueries.isLargeDevice()) {
                if (!this.isFirstSlide(this.slides[this.currentSlideIndex - this.offset]) && !this.isLastSlide(this.slides[this.currentSlideIndex - this.offset])) {
                    this.controllers.push(this.getNextSlide());
                    this.controllers.push(this.getPreviousSlide());
                } else {
                    this.controllers.push(this.isFirstSlide(this.slides[this.currentSlideIndex - this.offset]) ? this.getNextSlide() : this.getPreviousSlide());
                }
            }

            this.setControllersListeners();
        }

        return this;
    };

    this.init();
};

export var arrowSliderFactory = new SliderFactory();

export default ArrowSlider;