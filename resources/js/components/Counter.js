import { CounterFactory } from "../factories/CounterFactory";


function Counter(options) {
    this.items = [];

    this.init = function() {
        this.items = this.container.getElementsByClassName('stats__item');

        this.setCounters();
    };

    this.setCounters = function() {
        for (let i = 0; i < this.items.length; i++) {
            this.count(this.items[i]);
        }
    };

    this.count = function(item) {
        let counter = item.querySelector('.stats__item-counter')

        $(counter).prop('Counter', 0).animate({
            Counter: $(counter).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function(now) {
                $(this).text(Math.ceil(now));
            }
        })
    };
}

export default Counter;

export var counterFactory = new CounterFactory();