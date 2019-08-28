<section class="breadcumb_section">
    <ol>
        @auth
            @if(Auth::user()->type !== 'admin')
                <li class="breadcrumb-item"><a href="{{ route('offers') }}">Volver a las ofertas</a></li>
            @else
                <li class="breadcrumb-item"><a href="{{ route('admin.offers') }}">Gestionar las ofertas</a></li>
            @endif
        @else
            <li class="breadcrumb-item"><a href="{{ route('offers') }}">Volver a las ofertas</a></li>
        @endauth
    </ol>
</section>