<nav>
    @include('partials.modal-login')
    <div class="navbar">
        <div class="col-12 navbar-expand-lg navbar_container">
            @auth()
                <a class="logo" href="{{ url('/') }}"><img src="{{ asset('./storage/images/logo.png') }}"></a>
            @endauth
            @guest()

                <a class="logo" href="{{ url('/') }}"><img src="{{ asset('./storage/images/logo.png') }}"></a>
            @endguest
            <button class="toggleMenu navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar_items">
                    <li>
                        @auth
                            @if(Auth::user()->type !== 'admin')
                                <a href="{{ url('/internship') }}">
                                    <div class="toggleOption">{{ __('links.internship') }}</div>
                                </a>
                            @else
                                <a href="{{ route('admin.offers') }}">
                                    <div class="toggleOption">{{ __('links.internship') }}</div>
                                </a>
                            @endif
                        @else
                            <a href="{{ url('/internship') }}">
                                <div class="toggleOption">{{ __('links.internship') }}</div>
                            </a>
                        @endauth
                    </li>
                    <li>
                        <a href="{{ url('/learn/1') }}">
                            <div class="toggleOption">{{ __('links.learn chinese') }}</div>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="nav-item" data-target="#university" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="toggleOption" >{{ __('links.university') }}<i class="fas fa-angle-right"></i></div>
                        </a>

                        <ul id="university" class="dropdown-menu accordion_submenu" role="menu" aria-labelledby="university">
                            <li>
                                <a href="" class="dropdown-item">
                                    <div class="toggleOption">{{ __('links.master of business administration acronym') }}</div>
                                </a>
                            </li>

                            <li>
                                <a href="" class="dropdown-item" >
                                    <div class="toggleOption">{{ __('links.master of international business acronym') }}</div>
                                </a>
                            </li>

                            <li>
                                <a href="" class="dropdown-item" >
                                    <div class="toggleOption">{{ __('links.other studies') }}</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ url('why') }}">
                            <div class="toggleOption">{{ __('links.whyus') }}</div>
                        </a>
                    </li>
                    @guest
                        <li>
                            <a class="nav-item" data-toggle="modal" data-target="#loginModal">
                                <div class="toggleOption">{{ __('auth.login') }}</div>
                            </a>
                        </li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="nav-item" data-target="#userMenu" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">
                                <div class="toggleOption" >{{ Auth::user()->name }}<i class="fas fa-angle-right"></i></div>
                            </a>

                            <ul id="userMenu" class="dropdown-menu accordion_submenu" role="menu" aria-labelledby="userMenu">
                                <li>
                                    <a href="" class="dropdown-item">
                                        <div class="toggleOption">Cambiar Contraseña</div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        <div class="toggleOption">{{ __('auth.logout') }}</div>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest

                    <li class="dropdown inline-items">
                        <div class="toggleOption" data-toggle="dropdown">
                            @if(App::isLocale('es'))
                                <a href="#" class="selected">ES</a>
                            @else
                                <a href="#">ES</a>
                            @endif
                            @if(App::isLocale('en'))
                                <a href="#" class="selected">EN</a>
                            @else
                                <a href="#">EN</a>
                            @endif
                        </div>
                        <a href="#" data-target="#language" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="toggleOption" >ES<i class="fas fa-angle-right"></i></div>
                        </a>

                        <ul id="language" class="dropdown-menu accordion_submenu" role="menu" aria-labelledby="language">
                            <li>
                                <a href="#" class="dropdown-item">
                                    <div class="toggleOption">{{ __('links.spanish locale acronym') }}</div>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="dropdown-item" >
                                    <div class="toggleOption">{{ __('links.english locale acronym') }}</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="social-media-nav">
                        <div class="media" id="media">
                            <a href="https://www.linkedin.com/company/intuuchina" class="social-media-nav-links"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://www.facebook.com/intuuchina" class="social-media-nav-links"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://instagram.com/intuuchina" class="social-media-nav-links"><i class="fab fa-instagram s"></i></a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</nav>