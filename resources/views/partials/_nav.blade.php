<nav>
    @include('partials.modal-login')
    <div class="navbar">
        <div class="col-lg-2 col-md-12 navbar_menu">
            @auth()
                <a class="logo" href="{{ url('/') }}"><img src="storage/images/logo.png"></a>
            @endauth
            @guest()

                <a class="logo" href="{{ url('/') }}"><img src="../storage/images/logo.png"></a>
            @endguest
            <button class="toggleMenu"><i class="fas fa-bars"></i></button>
        </div>
        <ul class="col-lg-10 navbar_menu navbar_menu--hidden">
            <li>
                <a href="/internship">
                    <div class="toggleOption">Prácticas</div>
                </a>
            </li>
            <li>
                <a href="{{ url('/learn/1') }}">
                    <div class="toggleOption">Aprende Chino</div>
                </a>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-item" data-target="#university" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">
                    <div class="toggleOption" >Universidad<i class="fas fa-angle-right"></i></div>
                </a>

                <ul id="university" class="dropdown-menu accordeon" role="menu" aria-labelledby="university">
                    <li>
                        <a href="" class="dropdown-item selection">
                            <div class="toggleOption">MBI</div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item selection" >
                            <div class="toggleOption">Master of International Business</div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item selection" >
                            <div class="toggleOption">Other</div>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="/why">
                    <div class="toggleOption">Why Us</div>
                </a>
            </li>
            @guest
                <li>
                    <a class="nav-item" data-toggle="modal" data-target="#loginModal">
                        <div class="toggleOption">Login</div>
                    </a>
                </li>
            @else
                <li class="dropdown">
                    <a href="#" class="nav-item" data-target="#userMenu" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">
                        <div class="toggleOption" >{{ Auth::user()->name }}<i class="fas fa-angle-right"></i></div>
                    </a>

                    <ul id="userMenu" class="dropdown-menu accordeon" role="menu" aria-labelledby="userMenu">
                        <li>
                            <a href="" class="dropdown-item selection">
                                <div class="toggleOption">Cambiar Contraseña</div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item selection" >
                                <div class="toggleOption">Cerrar Sessión</div>
                            </a>
                        </li>
                    </ul>
                </li>
        @endguest

            <li class="inline-items">
                <div class="toggleOption">
                    @if(App::isLocale('es'))
                        <a href="#" class="selected">ES</a>
                    @else
                        <a href="#">ES</a>
                    @endif
                    @if(App::isLocale('en'))
                        <a href="#" class="selected">ING</a>
                    @else
                        <a href="#">IN</a>
                    @endif
                </div>
                <a href="#" class="nav-item" data-target="#language" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">
                    <div class="toggleOption" >ES</div>
                </a>
                <ul id="language" class="dropdown-menu accordeon" aria-labelledby="language">
                    <li>
                        <a href="#">
                            <div class=" ">
                                <p><a href="#"></a>ES</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="selection ">
                                <p><a href="#"></a>ENG</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="social-media-nav">
                <div class="media" id="media">
                    <a href="https://www.linkedin.com/company/intuuchina" class="social-media-nav-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://www.facebook.com/intuuchina" class="social-media-nav-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com/intuuchina" class="social-media-nav-link"><i class="fab fa-instagram s"></i></a>
                </div>
            </li>
        </ul>
    </div>
</nav>