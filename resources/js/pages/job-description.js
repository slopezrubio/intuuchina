import { bottomNavigationFactory } from "../components/BottomNavigation";

(function() {
    window.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('job-description') !== null) {
            var offerNavigation = bottomNavigationFactory.createNavigation({
                el: document.querySelector('.bottom-navigation'),
                type: 'bottom'
            }).init();
        }
    });
})();