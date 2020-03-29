import BottomNavigation from '../components/BottomNavigation';

export function NavigationFactory() {}

NavigationFactory.prototype.navigationClass = null;

NavigationFactory.prototype.createNavigation = function(options) {
    switch(options.type) {
        case 'bottom':
            this.navigationClass = BottomNavigation;
            break;
    }

    let navigationClass = new this.navigationClass(options);
    navigationClass.el = options.el;

    return navigationClass;
};