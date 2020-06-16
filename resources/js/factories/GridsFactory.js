import SquareGrid from '../components/SquareGrid';

export function GridFactory() {}

GridFactory.prototype.gridClass = null;

GridFactory.prototype.createGrid = function(options) {

    if (options.el.classList.contains('square-grid')) {
        this.gridClass = SquareGrid
    }

    let gridClass = new this.gridClass(options);

    gridClass.el = options.el;

    return gridClass;
};