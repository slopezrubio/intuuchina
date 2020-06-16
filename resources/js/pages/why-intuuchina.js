import { squareGridFactory } from "../components/SquareGrid";
import {counterFactory} from "../components/Counter";

(function() {

    window.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('why-intuuchina') !== null) {
            var squareGrid = squareGridFactory.createGrid({
                el: document.getElementById('why-intuuchina').querySelector('.square-grid')
            }).init();

            var statsCounter = counterFactory.createCounter({
                el: document.querySelector('.stats__container')
            }).init();
        }
    })
})();