import { bottomNavigationFactory } from "../components/BottomNavigation";

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        var offerNavigation = bottomNavigationFactory.createNavigation({
            el: document.querySelector('.bottom-navigation'),
            type: 'bottom'
        }).init();
    });
})();