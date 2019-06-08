let pageTitle = {
    init: () => {
        pageTitle.setup();
    },
    header: document.getElementsByTagName('header')[0],
    setup: () => {
        let currentPage = $(pageTitle.header).attr('id');
        if (pageTitle.pages[currentPage] !== null) {
            pageTitle.pages[currentPage]();
        }
    },
    pages: {
        'job-description': function() {
            let picture = pageTitle.getDataContent(pageTitle.header);
            pageTitle.header.style.setProperty('background-image',`url('${picture}')`);
        }
    },
    getDataContent: (element) => {
        return $(element).attr('data-content');
    }

};

if (document.getElementsByTagName('header') !== null) {
    pageTitle.init();
}