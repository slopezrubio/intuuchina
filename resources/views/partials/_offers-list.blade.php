<div class="container-fluid offers">
    <div class="card-group offers_list">
        @foreach($offers as $offer)
            <div class="card shadow">
                <div class="card-shutter">{{ $offer->industry }}</div>
                <img src="{{ $offer->picture }}" alt="Offer card image" class="card-img-top">
                <div class="card-body mb-2">
                    <h5 class="card-title">{{ $offer->title }}</h5>
                    <p class="card-text location">{{ ucfirst($offer->location) }}</p>
                    @if($offer->duration > 1)
                        <p class="card-text duration">Estancia: {{ $offer->duration }} Months</p>
                    @else
                        <p class="card-text duration">Estancia: {{ $offer->duration }} Month</p>
                    @endif
                    <div class="offers_buttons">
                        <button class="cta col-12 col-xs-5 col-sm-12 col-md-5"><a href="register">Inscribirse</a></button>
                        <button class="cta col-12 col-xs-5 col-sm-12 col-md-5"><a href="/internship/{{ $offer->id }}">Detalles</a></button>
                    </div>
                </div>
                <div class="card-footer mb-2">
                    <small class="text-muted">{{ $offer->gone_by }}</small>
                </div>
            </div>
        @endforeach
    </div>
</div>