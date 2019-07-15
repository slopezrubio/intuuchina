import breakpoints from '../main/breakpoints';
import dom from '../main/dom';
import env from '../main/env';

let motifs = {
    sections: document.getElementsByClassName('motifs'),
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

        motifs.placePicturesAsBackground();
      },
      mediumDevice: () => {
          if (!breakpoints.isMediumDevice()) {

              return false;
          }

          console.log('is medium');
      },
      largeDevice: () => {
          if (!breakpoints.isLargeDevice()) {

              return false;
          }


      },
    },
    placePicturesAsBackground: () => {
        for (let i= 0; i < motifs.sections.length; i++) {
            if (motifs.sections[i].querySelector('.motif_picture') !== null) {
                let picture = motifs.sections[i].querySelector('.motif_picture').getElementsByTagName('img')[0];
                dom.toggleSingleClass(motifs.sections[i], 'unified');
                motifs.setBackgroundImage(picture.getAttribute('src'), motifs.sections[i].querySelector('.motif_card'));
            }
        }
    },
    setBackgroundImage: (picture, element) => {
        let filter = /\w+\.(jpe?g|gif|svg|png)$/g;
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