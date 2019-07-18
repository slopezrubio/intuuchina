import breakpoints from '../main/breakpoints';
import dom from '../main/dom';
import env from '../main/env';

let motifs = {
    sections: document.getElementsByClassName('motifs'),
    container: document.querySelector('.container-fluid'),
    init: () => {
      window.addEventListener('load',motifs.setup);
      window.addEventListener('resize', function() {
          motifs.setup();
      });
    },
    setup: () => {
      Object.keys(motifs.preparedFor).map(function(key) {
          motifs.preparedFor[key]();
      });
    },
    preparedFor: {
      smallDevice: () => {
        if (!breakpoints.isSmallDevice()) {
            return false;
        }
      if (motifs.currentGrid(motifs.container) !== 'grid-sd') {
          dom.toggleClass(motifs.container, motifs.currentGrid(motifs.container), 'grid-sd');
      }
        motifs.placePicturesAsBackground();
      },
      mediumDevice: () => {
          if (!breakpoints.isMediumDevice()) {
              return false;
          }
          if (motifs.currentGrid(motifs.container) !== 'grid-md') {
                dom.toggleClass(motifs.container, motifs.currentGrid(motifs.container), 'grid-md');
          }
          motifs.removePictureAsBackground();
      },
      largeDevice: () => {
          if (!breakpoints.isLargeDevice()) {
              return false;
          }

          if (motifs.currentGrid(motifs.container) !== 'grid-ld') {
              dom.toggleClass(motifs.container, motifs.currentGrid(motifs.container), 'grid-ld');
          }

          motifs.removePictureAsBackground();
      },
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
    pathToImages: (path) => {

    }
}

if (document.querySelector('.motifs') !== null) {
   motifs.init();
}