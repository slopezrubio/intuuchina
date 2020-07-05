import Infography from '../components/Infography';

export function InfographyFactory() {};

InfographyFactory.prototype.infographyClass = Infography;

InfographyFactory.prototype.createInfography = function(options) {
    this.infographyClass = Infography;

    let infographyClass = new this.infographyClass(options);

    infographyClass.el = options.el;

    return infographyClass;
};