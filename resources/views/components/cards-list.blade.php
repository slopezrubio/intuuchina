<div class="cards-list col-12">
    @if ($items->count() === 0 || $items->currentPage() > $items->lastPage())
        <p class="cards-list__empty">{{ __('content.there are no', ['item' => 'offers']) }}</p>
    @else
        <div class="card-group">
            @foreach($items as $item)
                <div class="card shadow">
                    <div class="card__shutter">{{ $item->category }}</div>
                    <div class="card__window">
                        <img src="{{ asset('storage/images/' . $item->thumbnail) }}" alt="Offer card image" class="card-img-top horizontally-centered grayscale">
                    </div>

                    <div class="card-body mb-2">
                        <h5 class="card-body__title"><a href="/internship/{{ $item->id }}">{{ $item->title }}</a></h5>
                        <div class="card-body__subtitle mb-3">
                            <p class="card-text"><strong>{{ strtoupper($item->subtitle) }}</strong></p>
                            <p class="card-text">{{ trans_choice('content.staying', $item->time, ['time' => $item->time ]) }}</p>
                        </div>
                        <div class="card-body__action">
                            @if(isset($action))
                                @include($action)
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans(Carbon\Carbon::now()) }}</small>
                    </div>
                </div>
            @endforeach
        </div>

        {!! isset($pagination) ? $pagination : $items->links('vendor.pagination.semantic-ui') !!}
    @endif
</div>