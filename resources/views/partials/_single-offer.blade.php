<main>
    <section class="breadcumb_section">
        <ol>
            <li class="breadcrumb-item"><a href="{{ route('offers') }}">Volver a las ofertas</a></li>
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
    <section class="sendable_section--fixed">
        <div class="offers_buttons">
            <button class="cta col-12 col-xs-5 col-sm-12 col-md-5 mt-0"><a href="register">Inscribirse</a></button>
        </div>
    </section>
</main>