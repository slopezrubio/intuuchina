@component('components.modal')
    @include('partials.forms._login')
@endcomponent

<nav>
    <div class="navbar">
        <div class="col-12 navbar-expand-lg navbar_container">
            <a class="logo" href="{{ url('/') }}"><img src="{{ __('pictures.corporation logo.url') }}" alt="{{ __('pictures.corporation logo.alt') }}"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar_items">
                    @if(!empty(__('component.navbar')))
                        @foreach(__('component.navbar') as $key => $item)
                            @if(!isset($item['options']))
                                <li>
                                    <a href="{{ $item['url'] }}">
                                        <div class="toggleOption">{{ $item['text'] }}</div>
                                    </a>
                                </li>
                            @else
                                <li class="dropdown">
                                    <a href="{{ url($item['url']) }}" class="nav-item" data-target="{{ '#' . $key }}" data-toggle="none" aria-haspopup="true" aria-expanded="false">
                                        <div class="toggleOption" >{{ $item['text'] }}<i class="fas fa-angle-right"></i></div>
                                    </a>

                                    <ul id="{{ $key }}" class="dropdown-menu accordion_submenu" role="menu" aria-labelledby="{{ $key }}">
                                        @foreach($item['options']() as $key => $option)
                                            <li>
                                                <a href="{{ $option['url'] }}" class="dropdown-item">
                                                    <div class="toggleOption">{{ $option['text'] }}</div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    @endif

                    @guest
                        <li>
                            <a class="nav-item" data-toggle="modal" data-target="#loginModal">
                                <div class="toggleOption">{{ trans('auth.login') }}</div>
                            </a>
                        </li>
                    @else
                        <li class="dropdown">
                            <a href="{{ route('home') }}" class="nav-item" data-target="#userMenu" data-toggle="none" aria-haspopup="true" aria-expanded="false">
                                <div class="toggleOption" >{{ Auth::user()->name }}<i class="fas fa-angle-right"></i></div>
                            </a>

                            <ul id="userMenu" class="dropdown-menu accordion_submenu" role="menu" aria-labelledby="userMenu">
                                <li>
                                    <a href="{{ Auth::user()->type !== 'admin' ? route('password.change', ['token' => Str::random(30)]) : route('admin.password.change', ['token' => Str::random(30)])}}" class="dropdown-item">
                                        <div class="toggleOption">{{ trans('auth.change pass') }}</div>
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
                                @if (Auth::user()->type !== 'admin')
                                    <li>
                                        <a href="{{ route('home') }}" class="dropdown-item">
                                            <div class="toggleOption">{{ __('auth.application status') }}</div>
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    @if (Auth::user()->type !== 'admin')
                                        <a href="{{ route('user.profile')}}" class="dropdown-item">
                                            <div class="toggleOption">{{ __('auth.profile') }}</div>
                                        </a>
                                    @else
                                        <a href="{{ route('admin', ['user' => Auth::id()]) }}" class="dropdown-item">
                                            <div class="toggleOption">{{ __('auth.dashboard') }}</div>
                                        </a>
                                    @endif
                                </li>
                            </ul>
                        </li>
                    @endguest

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