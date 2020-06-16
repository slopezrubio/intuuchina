import Counter from '../components/Counter';

export function CounterFactory() {}

CounterFactory.prototype.counterClass = null;

CounterFactory.prototype.createCounter = function(options) {

    this.counterClass = Counter;

    let counterClass = new this.counterClass(options);

    counterClass.container = options.el;

    return counterClass;
};