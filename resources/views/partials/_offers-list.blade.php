@auth
    @if (count($offers) === 0)
        <div class="cards-list">
            <p class="cards-list__empty">{{ __('content.there are no', ['item' => 'offers']) }}</p>
        </div>
    @else
        <div class="cards-list">
            <div class="card-group">
                @foreach($offers as $offer)
                    <div class="card shadow">
                        <div class="card__shutter">{{ $offer->industry }}</div>
                        <div class="card__window">
                            <img src="{{ asset('storage/images/' . $offer->picture) }}" alt="Offer card image" class="card-img-top horizontally-centered grayscale">
                        </div>

                        <div class="card-body mb-2">
                            <h5 class="card-body__title"><a href="/internship/{{ $offer->id }}">{{ $offer->title }}</a></h5>
                            <div class="card-body__subtitle mb-3">
                                <p class="card-text"><strong>{{ strtoupper($offer->location) }}</strong></p>
                                <p class="card-text">{{ trans_choice('content.staying', $offer->duration, ['time' => $offer->duration ]) }}</p>
                            </div>
                            <div class="card-body__action">
                                @if (Auth::user()->program === 'internship' || Auth::user()->program === 'inter_relocat')
                                    <form class="card-form" action="{{ route('update.program', ['user' => Auth::user()->id, 'program' => Auth::user()->program]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ Auth::user()->program }}" name="program">
                                        <input type="hidden" value="{{ $offer->industry}}" name="industry">
                                        @if (Auth::user()->getIndustries() === null)
                                            <button type="submit" class="cta">{{ __('content.apply for') }}</button>
                                        @elseif(!array_key_exists($offer->industry, Auth::user()->getIndustries()))
                                            <button type="submit" class="cta">{{ __('content.i\'m also interested') }}</button>
                                        @endif
                                        <button class="cta"><a href="/internship/{{ $offer->id }}">{{ __('content.description') }}</a></button>
                                    </form>
                                @else
                                    <form class="card-form" action="{{ route('change.program', ['user' => Auth::user()->id ]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ Auth::user()->program }}" name="program">
                                        <input type="hidden" value="{{ $offer->industry }}" name="industry">
                                        <button type="submit" class="cta">{{ __('content.change preference') }}</button>
                                        <button class="cta"><a href="/internship/{{ $offer->id }}">{{ __('content.description') }}</a></button>
                                    </form>
                                @endif
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
@else
    @if (count($offers) === 0)
        <div class="cards-list">
            <p class="cards-list__empty">{{ trans_choice('content.there are no', ['item' => 'offers']) }}</p>
        </div>
    @else
        <div class="cards-list">
            <div class="card-group">
                @foreach($offers as $offer)
                    <div class="card shadow">
                        <div class="card__shutter">{{ $offer->industry }}</div>
                        <div class="card__window">
                            <img src="{{ asset('storage/images/' . $offer->picture) }}" alt="Offer card image" class="card-img-top horizontally-centered grayscale">
                        </div>
                        <div class="card-body mb-2">
                            <h5 class="card-body__title"><a href="/internship/{{ $offer->id }}">{{ $offer->title }}</a></h5>
                            <div class="card-body__subtitle mb-3">
                                <p class="card-text"><strong>{{ strtoupper($offer->location) }}</strong></p>
                                <p class="card-text">{{ trans_choice('content.staying', $offer->duration, ['time' => $offer->duration ]) }}</p>
                            </div>
                            <div class="card-body__action">
                                <form class="card-form" id="#applyJob" action="{{ route('application.form') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="inter_relocat" name="program" id="program">
                                    <input type="hidden" value="{{ $offer->industry }}" name="inter_relocat">
                                    <button class="cta" type="submit" value="industry" name="product">{{ __('content.apply for') }}</button>
                                    <button class="cta"><a href="/internship/{{ $offer->id }}">{{ __('content.description') }}</a></button>
                                </form>
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
@endauth

@if ((isset($isAjax) && !$isAjax) || (isset($isNewFilter) && $isNewFilter))
    @if (count($offers) > 0)
        {!! $offers->links() !!}
    @endif
@endif