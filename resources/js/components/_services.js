import news from '../components/_news';
import breakpoints from '../main/breakpoints';

let services = {
    container: document.querySelector('.services'),
    init: () => {
        window.addEventListener('load', services.setup);
        window.addEventListener('resize', services.setup);
    },
    setup: (event) => {
        services.setContainer(event);
    },
    setContainer: (event) => {
        if (news.polygon !== null) {
            let containerTopPosition = services.getContainerPosition();
            let main = $('main');
            let sections = $('main > section');
            Object.keys(sections).forEach(function(key) {
                if (parseInt(key) || key == 0) {
                    if (event.type === 'load') {
                        $(sections[key]).css({
                            'position': 'relative',
                            'top': containerTopPosition * -1 + 'px',
                        });
                    }

                    /*if (event.type === 'resize') {
                        $(sections[key]).css({
                            'top': containerTopPosition * -1 + 'px',
                        });
                    }*/
                }
            });
            //services.fixPositionRelative(main, containerTopPosition);
        }
    },
    fixPositionRelative: (element, displacedPosition, event) => {
        $(element).height('auto');
        $(element).height($(element).height() - displacedPosition);
    },
    getContainerPosition: () => {
        let percentage = breakpoints.isMediumDevice() ? 0.22 : 0.19;
        return news.polygon.clientHeight * percentage;
    }
}

if (services.container !== null) {
    services.init();
}