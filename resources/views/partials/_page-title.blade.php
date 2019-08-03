<section class="main-section--primary">
    <div class="title-card col-10 col-xs-10 col-sm-10 col-md-8 ">
        @if( Request::is('/'))
            @auth
                @if(Auth::user()->type !== 'admin')
                    <button class="cta col-10 col-xs-10 col-sm-8 col-md-8 col-lg-4"><a href="{{ route('offers') }}">Ver ofertas<i class="fas fa-chevron-right"></i></a></button>
                @else
                    <button class="cta col-10 col-xs-10 col-sm-8 col-md-8 col-lg-4"><a href="{{ route('admin.offers') }}">Ver ofertas<i class="fas fa-chevron-right"></i></a></button>
                @endif
            @else
                <button class="cta col-10 col-xs-10 col-sm-8 col-md-8 col-lg-4"><a href="{{ route('offers') }}">Ver ofertas<i class="fas fa-chevron-right"></i></a></button>
            @endauth
            <h1 class="title-card-header">Prácticas en primeras empresas del sector tecnológico</h1>
        @elseif(Request::is('register') || Request::is('register/options'))
            <h1 class="title-card-header">Regístrate</h1>
        @else
            <h1 class="title-card-header">{{ $params->title }}</h1>
        @endif
        @if( isset($params->subtitle) )
            <h2>{{ $params->subtitle }}</h2>
        @endif
    </div>
</section>
