import MediaQueries from '../main/breakpoints';
import DOM from '../main/dom.js';

if (document.getElementsByTagName('nav') !== null) {
    var nav = (function() {

        var _navbar =  document.querySelector('.navbar') ? document.querySelector('.navbar') : null;
        var _dropdowns = _navbar.querySelectorAll('li.dropdown') ? _navbar.querySelectorAll('li.dropdown') : null;
        var _dropdownItems = _navbar.querySelectorAll('a.dropdown-item') ? _navbar.querySelectorAll('a.dropdown-item') : null;
        var _modalForm = document.querySelector('.modal__form') !== null ?  document.querySelector('.modal__form') : null;
        var _accordionSubmenus = document.querySelectorAll('.accordion_submenu') !== null ?  document.querySelectorAll('.accordion_submenu') : null;

        var _listeners = {
            dropdown: function() {
                _dropdowns.forEach((dropdown) => {
                    if (MediaQueries.isNavbarBreakpoint()) {
                        dropdown.removeEventListener('click', setDropdowns);
                        dropdown.addEventListener('mouseenter', setDropdowns);
                        dropdown.addEventListener('mouseleave', setDropdowns);
                    } else {
                        dropdown.removeEventListener('mouseenter', setDropdowns);
                        dropdown.removeEventListener('mouseleave', setDropdowns);
                        dropdown.addEventListener('click', setDropdowns);
                    }
                })
            },
            dropdownItem: function() {
                _dropdownItems.forEach((item) => {
                    item.addEventListener('click', setDropdownItems)
                })
            }
        };

        function init() {
            window.addEventListener('load', function() {
                if (hasErrorsMessages(_modalForm)) {
                    showModal();
                };

                _listeners.dropdown();
                _listeners.dropdownItem();
            });

            window.addEventListener('resize', (e) => {
                _listeners.dropdown();
            });
        }

        function toggleDropdown(element) {
            if ($(element).hasClass('show')) {
                $(element).dropdown('hide');
            } else {
                $(element).dropdown('show');
            }
        }

        function hasErrorsMessages(element) {
            if ($(element).find('.is-invalid').length > 0) {
                return true;
            }

            return false;
        }

        function showModal() {
            $(_modalForm).modal();
        }

        function setDropdownItems(e) {
            let URL = e.target.getAttribute('href');
            let anchor = e.target;

            while (URL === null) {
                anchor = anchor.parentElement;
                URL = anchor.getAttribute('href');
            }

            location.href = URL;
        }

        function setDropdowns(e) {
            let submenu = getSubmenu(e.target);

            switch(e.type) {
                case 'click':
                    e.preventDefault();
                    if ($(e.target).hasClass('toggleOption')) {
                        location.href = e.target.parentElement.getAttribute('href');
                    } else {
                        toggleDropdown(submenu);
                    }
                    break;
                case 'mouseenter':
                    $(submenu).dropdown('show');
                    break;
                case 'mouseleave':
                    $(submenu).dropdown('hide');
                    break;
            }
        }

        function getSubmenu(menuItem) {
            let submenu = menuItem.querySelector('.dropdown-menu');

            if (submenu === null) {
                submenu = $(menuItem).parents('.dropdown-menu')[0];
                if (submenu === undefined) {
                    $(menuItem).parents().map(function() {
                        if ($(this).siblings('.dropdown-menu')[0]) {
                            submenu = $(this).siblings('.dropdown-menu')[0];
                            return submenu;
                        }
                    })
                }
            }

            return submenu;
        }

        init();

    })();
}


// let nav = {
//     init: () => {
//         nav.setup();
//     },
//     navbar:
//     dropdownItems: nav.navbar.querySelectorAll('.dropdown') !== undefined ? nav.navbar.querySelectorAll('.dropdown') : null,
//     modalForm: document.querySelector('.modal__form') !== null ?  document.querySelector('.modal__form') : null,
//     accordionSubmenus:  document.querySelectorAll('.accordion_submenu') !== null ?  document.querySelectorAll('.accordion_submenu') : null,
//     setup: () => {
//         /*
//          * Loads the login modal when there is some error coming
//          * from the form inside.
//          */
//         window.addEventListener('load', function() {
//             if (nav.hasErrorsMessages(nav.modalForm)) {
//                 nav.showModal();
//             };
//         });
//
//         console.log(nav.dropdownItems);
//
//         // for (let i=0; i < nav.navbar.querySelectorAll('.dropdown').length; i++) {
//         //     let dropdown = nav.navbar.querySelectorAll('.dropdown')[i];
//         //     console.log(dropdown);
//         //     dropdown.addEventListener('mouseover', (e) => {
//         //         e.stopPropagation();
//         //         if (MediaQueries.isNavbarBreakpoint()) {
//         //             let targetId = dropdown.querySelector('.nav-item').getAttribute('data-target');
//         //             console.log(targetId);
//         //             $(targetId).dropdown('show');
//         //         }
//         //     });
//         //
//         //     dropdown.addEventListener('click', (e) => {
//         //         /*if (!MediaQueries.isNavbarBreakpoint()) {
//         //             let targetId = dropdown.querySelector('.nav-item').getAttribute('data-target');
//         //             if ($(targetId.querySelector('ul')).hasClass('show')) {
//         //                 console.log("hola");
//         //                 $(targetId).dropdown('hide');
//         //             } else {
//         //                 $(targetId).dropdown('show');
//         //             }
//         //         }*/
//         //     });
//         //
//         //     dropdown.addEventListener('mouseout', function(e) {
//         //         if (MediaQueries.isNavbarBreakpoint()) {
//         //             let targetId = dropdown.querySelector('.nav-item').getAttribute('data-target');
//         //             $(targetId).dropdown('hide');
//         //         }
//         //     });
//         // }
//
//         for (let i=0; i < nav.accordionSubmenus.length; i++) {
//             nav.accordionSubmenus[i].addEventListener('mouseover', nav.highlightItem, true);
//             nav.accordionSubmenus[i].addEventListener('mouseout', nav.highlightItem, true);
//         }
//     },
//     highlightItem: function(event) {
//         if (!MediaQueries.isLargeDevice()) {
//             let pattern = /\s?show\s?/;
//             if (this.getAttribute('class').match(pattern)) {
//                 DOM.toggleSingleClass(this.parentElement, 'reverse-colours');
//             }
//         }
//     },
//     hasErrorsMessages: (parent) => {
//         if ($(parent).find('.is-invalid').length > 0) {
//             return true;
//         }
//
//         return false;
//     },
//     showModal: () => {
//         $('#loginModal').modal();
//     }
// }

// if (document.getElementsByTagName('nav') !== null) {
//     nav.init();
// }
