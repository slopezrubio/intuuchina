<div class="container-fluid offers">
    @if (count($offers) === 0)
        <p class="item_not_found">There are no offers with such characteristic</p>
    @else
        <div class="card-group offers_list">
            @foreach($offers as $offer)
                <div class="card shadow">
                    <div class="card-shutter">{{ $offer->industry }}</div>
                    <img src="{{ $offer->picture }}" alt="Offer card image" class="card-img-top">
                    <div class="card-body mb-2">
                        <h5 class="card-title"><a href="/internship/{{ $offer->id }}">{{ $offer->title }}</a></h5>
                        <p class="card-text location">{{ ucfirst($offer->location) }}</p>
                            <p class="card-text duration">Staying: {{ $offer->duration }} {{ $offer->duration > 1 ? 'Months' : 'Month' }}</p>
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
    @endif
</div>