<main>
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
    <section class="readable_section">
        <h3 class="readable_section_title">DESCRIPTION</h3>
        <p>{{ $offer->description }}</p>
    </section>
    <section class="readable_section">
        <h3 class="readable_section_title">DETAILS</h3>
        <div class="card_background-image" data-content="/../../storage/images/details_{{$offer->location }}.jpg">
            <div class="card_background-image_info">
                <p class="card-title">{{ ucfirst($offer->location) }}</p>
                    <p class="card-text">Duration<span class="month"><strong class="month_value">{{ $offer->duration }}</strong>{{ $offer->duration != 1 ? ' Months' : ' Month'}}</span></p>
            </div>
        </div>
    </section>
    @guest
        <section class="sendable_section">
            <div class="offers_buttons">
                <button class="cta col-12 col-xs-5 col-sm-12 col-md-5 mt-0"><a href="{{ route('register') }}">Inscribirse</a></button>
            </div>
        </section>
    @endguest
</main>