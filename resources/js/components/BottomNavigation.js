import { NavigationFactory } from "../factories/NavigationFactory";

import browser from "../facades/browser";

function BottomNavigation(options) {

    this.position = {};
    this.viewport = null;

    this.init = function() {
        this.setViewport()
            .setPosition()
            .toggle();

        window.addEventListener('resize', (ev) => {
            this.setViewport()
                .setPosition()
                .toggle();
        })

        window.addEventListener('scroll', (ev) => {
            this.setViewport()
                .toggle(ev);
        })
    };

    this.setViewport = function() {
        this.viewport = window.innerWidth;
        return this;
    };

    this.setPosition = function() {
        let previousElement = $(this.el).prev();

        if (previousElement !== null || previousElement.length === 0) {
            this.position.top = $(previousElement).offset().top + $(previousElement).height();
            this.position.bottom = this.position.top + this.el.clientHeight;
        }

        return this;
    };

    this.isFixed = function() {
        return $(this.el).hasClass('bottom-navigation--fixed')
    };

    this.scrollTo = function(position) {
        browser.scrollSmoothlyTo('top', position)
    };

    this.toggle = function(ev = null) {
        this.setPosition();

        if (browser.isElementScoped(this.position)) {
            if (this.isFixed()) {
                $(this.el).removeClass('bottom-navigation--fixed');
            }
            return this;
        }

        if (!this.isFixed()) {
            $(this.el).addClass('bottom-navigation--fixed');
        }

        return this;
    };
}

export var bottomNavigationFactory = new NavigationFactory();

export default BottomNavigation;