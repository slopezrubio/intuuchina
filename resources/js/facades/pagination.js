import browser from './browser';
import dom from './dom';

var pagination = (function() {
    var _ = {
        container: null,
        links: null,
        prevButton: null,
        nextButton: null,

        init: function( args ) {
            this.container = args.container;
            this.links = this.container.getElementsByClassName('items-pagination__link');
            this.offset = 1;
            this.currentPageLink = this.container.querySelector('.active');
            this.prevButton = this.container.querySelector('a[rel=\'prev\'');
            this.nextButton = this.container.querySelector('a[rel=\'next\'');
            this.splitters = this.container.getElementsByClassName('items-pagination__link--splitter');
            this.isExtendedPagination = true;

            this.setup();
        },

        setup: function() {
            this.getNonActivePageLinks(this.currentPageLink);

            this.addEvent(window, 'load', () => {
                this.setResponsive(this);
            });
            this.addEvent(window, 'resize', () => {
                this.setResponsive(this)
            });
        },

        getNonActivePageLinks: function(link) {
            let pageLinks = [];

            for (let i = 1; i < this.links.length - 1; i++) {
                if (!this.links[i].isEqualNode(link)) {
                    pageLinks.push(this.links[i]);
                }
            }

            return pageLinks;
        },

        setExtendedPagination: function(value) {
            this.isExtendedPagination = value;
        },

        setResponsive: function(self = this) {
            if (browser.isMediumDevice()) {
                if (this.isExtendedPagination) {
                    this.showSimplePagination()
                        .setExtendedPagination(false);
                }

                return this;
            }

            if (!this.isExtendedPagination) {
                this.showExtendedPagination()
                    .setExtendedPagination(true);
            }

            return true;
        },

        showExtendedPagination: function() {
            // dom.show(this.getNonActivePageLinks(this.currentPageLink))
            //
            // if (this.nextButton !== null) dom.show(this.nextButton.querySelector('span'), 'initial');
            // if (this.prevButton !== null) dom.show(this.prevButton.querySelector('span'), 'initial');

            return this;
        },

        showSimplePagination: function() {
            // dom.hide(this.getNonActivePageLinks(this.currentPageLink));
            //
            // if (this.nextButton !== null) dom.hide(this.nextButton.querySelector('span'), 'initial');
            // if (this.prevButton !== null) dom.hide(this.prevButton.querySelector('span'), 'initial');

            return this;
        },

        addEvent: (el, event, fn) => {
            if (el.addEventListener){
                el.addEventListener( event,fn, false );
            } else if(el.attachEvent){
                el.attachEvent( "on" + event, fn );
            } else{
                el["on" + event] = fn;
            }
        }
    };

    return {
        paginate: function( args ) {
            _.init(args);
        },
        hasPagination: function() {
            return document.querySelector('.items-pagination') !== null;
        }
    }
}());

export default pagination;