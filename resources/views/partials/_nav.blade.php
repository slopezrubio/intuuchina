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
                <a href="/learn">
                    <div class="toggleOption">Aprende Chino</div>
                </a>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-item" data-target="#university" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">
                    <div class="toggleOption" >Universidad</div>
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
                <li class="nav-item dropdown-toggle">
                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <div class="caret"></div>
                    </a>
                </li>
        @endguest

            <li class="inline-items">
                <div class="inline-item">
                    <a href="#">ES</a>
                    <a href="#">ING</a>
                </div>
{{--                <a href="#" class="nav-item" data-target="#language" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">--}}
{{--                    <div class="toggleOption" >ES</div>--}}
{{--                </a>--}}
{{--                <ul id="language" class="dropdown-menu accordeon" aria-labelledby="language">--}}
{{--                    <li>--}}
{{--                        <a href="#">--}}
{{--                            <div class=" ">--}}
{{--                                <p><a href="#"></a>ES</p>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#">--}}
{{--                            <div class="selection ">--}}
{{--                                <p><a href="#"></a>ENG</p>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
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