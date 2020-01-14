@if (count($offers) === 0)
    <div class="container-fluid offers">
        <p class="item_not_found">There are no offers with such characteristic</p>
    </div>
@else
    <div class="container-fluid offers">
        <div class="card-group offers_list">
            @foreach($offers as $offer)
                <div class="card shadow">
                    <div class="card-shutter">{{ $offer->industry }}</div>
                    <div class="img-window">
                        <img src="{{ asset('storage/images/' . $offer->picture) }}" alt="Offer card image" class="card-img-top">
                    </div>

                    <div class="card-body mb-2">
                        <h5 class="card-title"><a href="/internship/{{ $offer->id }}">{{ $offer->title }}</a></h5>
                        <p class="card-text location">{{ ucfirst($offer->location) }}</p>
                        <p class="card-text duration">Staying: {{ $offer->duration }} {{ $offer->duration > 1 ? 'Months' : 'Month' }}</p>
                        <div class="offers_buttons">
                            <button class="cta col-12 col-xs-5 col-sm-12 col-md-5"><a class="edit" href="{{ url('/admin/offers/edit/' . $offer->id) }}">{{ __('content.edit') }}</a></button>
                            <button class="cta col-12 col-xs-5 col-sm-12 col-md-5"><a class="delete" data-value="{{ $offer->id }}" data-toggle="modal" data-target="#offerModal">{{ __('content.delete') }}</a></button>
                        </div>
                    </div>
                    <div class="card-footer mb-2">
                        <small class="text-muted">{{ $offer->gone_by }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif