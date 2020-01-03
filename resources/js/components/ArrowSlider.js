import MediaQueries from '../main/breakpoints';
import DOM from '../main/dom';

var ArrowSlider = (function() {
    var instance;

    function ArrowSliderClass(options) {
        // Private properties
        var holder = options.holder;
        var offset = 1;
        var currentSlideIndex = options.slide ? options.slide + offset : 1;
        var carousel = options.holder.children[0];
        var colors = options.colors;
        var slides = carousel.children;
        var controllers = addControllers(options.controllers);
        var controllersCallback = options.controllersCallback ? options.controllersCallback : null;
        var currentSlide = slides[currentSlideIndex - offset];

        function init() {
            for (let i = 0; i < slides.length; i++) {
                slides[i].autoWidth = function() {
                    autoWidth(this)
                }
            };

            // Make the slider responsive according to the screen resolution.
            setResponsive();

            /* ---------- RESIZE ------------*/
            window.addEventListener('resize', setResponsive);
        }

        function addControllers(controllers) {
            let sliderControllers = [];

            for (let i = 0; i < controllers.length; i++) {
                sliderControllers.push(controllers[i]);
            }

            return sliderControllers;
        }

        function runAutoWidths() {
            for (let i = 0; i < slides.length; i++) {
                slides[i].autoWidth()
            };
        }

        function autoWidth(slide) {
            $(slide).width(holder.clientWidth);

            if (MediaQueries.isLargeDevice()) {
                if (isCurrentSlide(slide)) {
                    $(slide).removeClass();
                    DOM.toggleSingleClass(slide, 'arrow-slider__slide--current');

                    if (isFirstSlide(slide)) {
                        DOM.toggleSingleClass(slide, 'first');
                    }

                    if (isLastSlide(slide)) {
                        DOM.toggleSingleClass(slide, 'last');
                    }
                }

                if (isPreviousSlide(slide)) {
                    $(slide).removeClass();
                    DOM.toggleSingleClass(slide, 'arrow-slider__slide--left');
                }

                if (isNextSlide(slide)) {
                    $(slide).removeClass();
                    DOM.toggleSingleClass(slide, 'arrow-slider__slide--right');
                }
            } else {
                $(slide).removeClass();
                DOM.toggleSingleClass(slide, 'arrow-slider__slide');
            }
        }

        function resetControllers() {
            if (slides.length < controllers.length) {
                for (let i = slides.length; i < controllers.length; i++) {
                    controllers.pop();
                }
            }
        }

        function updateController(e) {
            e.preventDefault();
            for (let x = 0; x < controllers.length; x++) {
                if (e.target.isEqualNode(controllers[x]) || e.target.parentElement.isEqualNode(controllers[x])) {
                    if (currentSlideIndex !== x + offset) {

                        // Update controllers.
                        DOM.toggleSingleClass(controllers[currentSlideIndex - offset], 'selected');
                        if (x >= slides.length) {
                            setCurrentSlide(isNextSlide(controllers[x]) ? currentSlideIndex : currentSlideIndex - (offset * 2));
                        } else {
                            setCurrentSlide(x);
                        }

                        DOM.toggleSingleClass(controllers[currentSlideIndex - offset], 'selected');

                        // Update the sliders.
                        runAutoWidths();

                        moveCarouselTo(currentSlideIndex);

                        paint();

                        if (controllersCallback !== null) {
                            controllersCallback(currentSlide);
                        }

                        setControllers();
                    }
                }
            }
        }

        function setControllers() {
            resetControllers();
            if (MediaQueries.isLargeDevice()) {
                if (!isFirstSlide(slides[currentSlideIndex - offset]) && !isLastSlide(slides[currentSlideIndex - offset])) {
                    controllers.push(slides[currentSlideIndex]);
                    controllers.push(slides[currentSlideIndex - (offset * 2)]);
                } else {
                    controllers.push(isFirstSlide(slides[currentSlideIndex - offset]) ? slides[currentSlideIndex] : slides[currentSlideIndex - (offset * 2)])
                }
            }

            for (let i = 0; i < controllers.length; i++) {
                controllers[i].removeEventListener('click', updateController);
                controllers[i].addEventListener('click', updateController);
            }
        }

        function setCurrentSlide(value) {
            currentSlideIndex = value + offset;
            currentSlide = slides[value];
        }

        function isCurrentSlide(slide) {
            return slide.isEqualNode(currentSlide);
        }

        function isNextSlide(slide) {
            return slide.isEqualNode(slides[currentSlideIndex]);
        }

        function isPreviousSlide(slide) {
            return slide.isEqualNode(slides[currentSlideIndex - (offset * 2)]);
        }

        function isFirstSlide(slide) {
            return slide.isEqualNode(slides[0]);
        }

        function isLastSlide(slide) {
            return slide.isEqualNode(slides[slides.length - offset]);
        }

        function setResponsive(e = null) {
            setControllers();

            // Update holder width
            $(carousel).width(holder.clientWidth * slides.length);

            // Update Slides autowidth
            runAutoWidths();

            // Move carousel to the current slide once the screen has been resized.
            moveCarouselTo(currentSlideIndex);

            paint()
        }

        function paint() {
            // Change carousel background to the proper color given
            carousel.style.background = colors[currentSlideIndex - offset];

            let isWhite = /^(white|#FFFFFF)\b|\s(white|#FFFFFF)\b/;
            let controllersContainer = controllers[currentSlideIndex - offset].parentElement;

            if (carousel.style.background.match(isWhite)) {
                if (!$(controllersContainer).hasClass('dark')) {
                    DOM.toggleSingleClass(controllersContainer, 'dark');
                }
            } else {
                if ($(controllersContainer).hasClass('dark')) {
                    DOM.toggleSingleClass(controllersContainer, 'dark');
                }
            }
        }

        function moveCarouselTo(slideIndex) {
            slideIndex -= offset;

            $(carousel).css({
                "-webkit-transform": "translateX(-" + (holder.clientWidth * slideIndex) + "px)",
                "transform": "translateX(-" + (holder.clientWidth * slideIndex) + "px)",
                "-moz-transform": "translateX(-" + (holder.clientWidth * slideIndex) + "px)",
                "-o-transform": "translateX(-" + (holder.clientWidth * slideIndex) + "px)",
            })
        }

        init();

        return {
            get: (key) => {
                return this[key];
            },

            set: (key, value) => {
                this[key] = value;
            }
        }
    }

    return {
        getInstance: function() {
            if (!instance) {
                instance = ArrowSliderClass;
            }

            return instance;
        }
    }
})();

export default ArrowSlider.getInstance();