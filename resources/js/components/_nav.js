import MediaQueries from '../main/breakpoints';
import DOM from '../main/dom.js';

if (document.getElementsByTagName('nav') !== null) {
    var navbar = (function() {

        var _navbar =  document.querySelector('.navbar') ? document.querySelector('.navbar') : null;
        var _dropdowns = _navbar.querySelectorAll('li.dropdown');
        var _dropdownItems = _navbar.querySelectorAll('a.dropdown-item');
        var _loginModal = document.querySelector('#loginModal');
        var _loginForm = _loginModal.querySelector('.modal__form');
        var _accordionSubmenus = _navbar.querySelectorAll('.accordion_submenu');

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
                if (hasErrorsMessages(_loginForm)) {
                    $(_loginModal).modal();
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

        function setDropdownItems(e) {
            e.preventDefault();
            let URL = e.target.getAttribute('href');
            let anchor = e.target;

            while (URL === null) {
                anchor = anchor.parentElement;
                URL = anchor.getAttribute('href');
            }

            if (anchor.nextElementSibling === null) {
                location.href = URL;
            } else {
                if (anchor.nextElementSibling.tagName !== 'FORM') {
                    location.href = URL;
                }
            }

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
