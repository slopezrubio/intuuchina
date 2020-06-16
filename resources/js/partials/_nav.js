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
            dropdown: function(dropdown) {
                if (MediaQueries.isNavbarBreakpoint()) {
                    dropdown.removeEventListener('click', setDropdowns);
                    dropdown.addEventListener('mouseenter', setDropdowns);
                    dropdown.addEventListener('mouseleave', setDropdowns);
                } else {
                    dropdown.removeEventListener('mouseenter', setDropdowns);
                    dropdown.removeEventListener('mouseleave', setDropdowns);
                    dropdown.addEventListener('click', setDropdowns);
                }
            },
            dropdownItem: function(item) {
                item.addEventListener('click', setDropdownItems)
            },
            shadows: function(ev) {

                if (ev.type === 'click' && ($(ev.target).hasClass('navbar-toggler') || $(ev.target.parentElement).hasClass('navbar-toggler'))) {
                    if (!isCollapsed()) {
                        return shadow();
                    }

                    return unshadow();
                }

                if (ev.type === 'load' || ev.type === 'scroll' || ev.type === 'resize') {
                    if (window.scrollY > 0) {
                        return shadow()
                    }

                    if (!MediaQueries.isNavbarBreakpoint()) {
                        if (isCollapsed()) {
                            return shadow();
                        }
                    }

                    return unshadow()
                }
            }
        };

        function init() {
            window.addEventListener('load', function(ev) {
                if (hasErrorsMessages(_loginForm)) {
                    $(_loginModal).modal();
                };

                _listeners.shadows(ev);

                for (let i = 0; i < _dropdowns.length; i++) {
                    _listeners.dropdown(_dropdowns[i]);
                }

                for (let y = 0; y < _dropdownItems.length; y++) {
                    _listeners.dropdownItem(_dropdownItems[y]);
                }
            });

            window.addEventListener('resize', (ev) => {
                for (let i = 0; i < _dropdowns.length; i++) {
                    _listeners.dropdown(_dropdowns[i]);
                }

                _listeners.shadows(ev);
            });

            window.addEventListener('scroll',(ev) => {
                _listeners.shadows(ev);
            });

            _navbar.querySelector('.navbar-toggler').addEventListener('click', (ev) => {
                _listeners.shadows(ev);
            })
        }

        function toggleDropdown(element) {
            if ($(element).hasClass('show')) {
                $(element).dropdown('hide');
            } else {
                $(element).dropdown('show');
            }
        }

        function shadow() {
            if (!$(_navbar).hasClass('navbar--shadowed')) {
                return _navbar.classList.add('navbar--shadowed');
            }
        }

        function unshadow() {
            if ($(_navbar).hasClass('navbar--shadowed')) {
                return _navbar.classList.remove('navbar--shadowed');
            }
        }

        function isCollapsed() {
            if (_navbar.querySelector('.navbar-toggler').style.display !== 'none') {
                return $(_navbar.querySelector('#navbarToggler')).hasClass('show');
            }

            return false;
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
