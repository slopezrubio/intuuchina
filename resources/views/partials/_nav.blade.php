<nav>
    @include('partials.modal-login')
    <div class="navbar">
        <div class="navbar_menu">
            @auth()
                <a class="logo" href="{{ url('/') }}"><img src="storage/images/logo.png"></a>
            @endauth
            @guest()
                    <a class="logo" href="{{ url('/') }}"><img src="../storage/images/logo.png"></a>
            @endguest
            <button class="toggleMenu"><i class="fas fa-bars" ></i></button>
        </div>

        <ul class="col-lg-9 col-lg-9 navbar_menu navbar_menu--hidden">
            <li><a href="{{ route('offers') }}">Prácticas</a></li>
            <li><a href="/learn">Aprende Chino</a></li>
            <li><a href="/university">Universidad</a></li>
            <li><a href="/why">Why Intuuchina</a></li>
            @guest
                <li><a class="nav-item" data-toggle="modal" data-target="#loginModal">Login</a></li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
            @endguest
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ES</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">EN</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
