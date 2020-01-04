import breakpoints from '../main/breakpoints';
import dom from '../main/dom';
import env from '../main/env';

let motifs = {
    sections: document.getElementsByClassName('motifs') !== null ? document.getElementsByClassName('motifs') : null,
    container: document.querySelector('.mx-width') !== null ? document.querySelector('.mx-width') : null,
    motifs: document.querySelectorAll('.motif_card, .motif_picture') !== null ? document.querySelectorAll('.motif_card, .motif_picture') : null,
    highestMotif: '',
    init: () => {
      window.addEventListener('load',motifs.setup);
      window.addEventListener('resize', function() {
          motifs.setup();
      });
    },
    setup: () => {
        motifs.setContainer();
        Object.keys(motifs.preparedFor).map(function(key) {
          motifs.preparedFor[key]();
        });

        motifs.highestMotif = motifs.highestMotif === '' ? motifs.getHighestMotif() : motifs.highestMotif;
        motifs.setHeight();

    },
    getHighestMotif: () => {
        let highest = '';
        for (let i = 0; i < motifs.motifs.length; i++) {
            if (getComputedStyle(motifs.motifs[i], null).display !== 'none' && motifs.motifs[i].getAttribute('class') === "motif_card") {
                highest = highest === '' ? motifs.motifs[i] : highest;
                if (motifs.motifs[i].style.height === '' && motifs.motifs[i].offsetHeight >= highest.offsetHeight) {
                    highest = motifs.motifs[i];
                }
            }
        }

        return highest;

    },
    setHeight: () => {
        for (let i = 0; i < motifs.motifs.length; i++) {
            if (getComputedStyle(motifs.motifs[i], null).display !== 'none') {
                if (!motifs.motifs[i].isEqualNode(motifs.highestMotif)) {
                    if (!breakpoints.isSmallDevice()) {
                        motifs.motifs[i].style.height = '';
                    } else {
                        motifs.motifs[i].style.height = motifs.highestMotif.offsetHeight + 'px';
                    }


                }
            }
            //motifs.motifs[i].style.height = !motifs.motifs[i].isEqualNode(motifs.highestMotif) ? `${motifs.highestMotif.clientHeight}px` : `auto`;
        }
    },
    preparedFor: {
      smallDevice: () => {
        if (!breakpoints.isSmallDevice()) {
            return false;
        };

        if (motifs.currentGrid(motifs.container) !== 'grid-sd') {
            motifs.highestMotif = '';
            dom.toggleClass(motifs.container, motifs.currentGrid(motifs.container), 'grid-sd');
        };

        motifs.placePicturesAsBackground();
      },
      mediumDevice: () => {
          if (!breakpoints.isMediumDevice()) {
              return false;
          };

          if (motifs.currentGrid(motifs.container) !== 'grid-md') {
              dom.toggleClass(motifs.container, motifs.currentGrid(motifs.container), 'grid-md');
          };

          motifs.removePictureAsBackground();
      },
      largeDevice: () => {
          if (!breakpoints.isLargeDevice()) {
              return false;
          };

          if (motifs.currentGrid(motifs.container) !== 'grid-ld') {
              dom.toggleClass(motifs.container, motifs.currentGrid(motifs.container), 'grid-ld');
          };

          motifs.removePictureAsBackground();
      },
    },
    setContainer: () => {
        if (!$(motifs.container).hasClass('shadow')) {
            if (window.innerWidth >= 1382) {
                dom.toggleSingleClass(motifs.container, 'shadow');
                return true;
            }
        };

        if (window.innerWidth < 1382) {
            dom.toggleSingleClass(motifs.container, 'shadow');
        };

        return true;
    },
    removePictureAsBackground: () => {
        if (document.querySelector('.unified') !== null) {
            for (let i= 0; i < motifs.sections.length; i++) {
                if (motifs.sections[i].querySelector('.motif_picture') !== null) {
                    let card = motifs.sections[i].querySelector('.motif_card');
                    $(card).css("background", "none");
                    dom.toggleSingleClass(motifs.sections[i], 'unified');
                    dom.toggleSingleClass(motifs.sections[i], 'black_and_white');
                }
            }
        }
    },
    placePicturesAsBackground: () => {
        if (document.querySelector('.unified') === null) {
            for (let i = 0; i < motifs.sections.length; i++) {
                if (motifs.sections[i].querySelector('.motif_picture') !== null) {
                    let picture = motifs.sections[i].querySelector('.motif_picture').getElementsByTagName('img')[0];
                    dom.toggleSingleClass(motifs.sections[i], 'unified');
                    motifs.setBackgroundImage(picture.getAttribute('src'), motifs.sections[i].querySelector('.motif_card'));
                    dom.toggleSingleClass(motifs.sections[i], 'black_and_white');
                }
            }
        }
    },
    currentGrid: (element) => {
        let pattern = /\s*grid-(m|s|l)d\s*/g;
        let grid = ($(element).attr('class').match(pattern));
        grid = grid[0].replace(/\s/g, '');
        return grid;
    },
    setBackgroundImage: (picture, element) => {
        let filter = /\w+\.(jpe?g|gif|svg|png)$/g;
        picture = picture.replace(/desktop/, 'mobile');
        let url = env.paths.public + 'storage/images/' + picture.match(filter);
        $(element).css("background", 'url(\'' + url + '\') no-repeat scroll center');
        $(element).css("background-size", "cover");
    },
};

if (document.querySelector('.motifs') !== null) {
   motifs.init();
}