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

        this.position.top = $(previousElement).offset().top + $(previousElement).height();
        this.position.bottom = this.position.top + this.el.clientHeight;

        return this;
    };

    this.isFixed = function() {
        return $(this.el).hasClass('bottom-navigation--fixed')
    };

    this.scrollTo = function(position) {
        browser.scrollSmoothlyTo('top', position)
    };

    this.toggle = function(ev = null) {
        if (browser.isElementScrolledIntoView(this.position)) {
            if (this.isFixed()) {
                $(this.el).removeClass('bottom-navigation--fixed');
                if (ev !== null && ev.type === 'scroll') {
                    //console.log($(this.el).offset().top + this.el.clientHeight);
                    // TODO
                    // this.scrollTo(window.scrollY + ($(this.el).bottom())
                }
            }
            return this;
        };

        if (!this.isFixed()) {
            $(this.el).addClass('bottom-navigation--fixed');
        }

        return this;
    };
}

export var bottomNavigationFactory = new NavigationFactory();

export default BottomNavigation;