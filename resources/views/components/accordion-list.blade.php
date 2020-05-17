@if(isset($items) && $items->total() > 0 && $items->currentPage() <= $items->lastPage())
    <div id="{{ isset($id) ? $id : 'accordion' }}" class="accordion-list">
        @foreach($items as $key => $item)
            <div class="card accordion-list__card">
                <div class="card-header accordion-list__card-header" id="heading-{{ $loop->iteration }}">
                    @if(property_exists($item, 'picture'))
                        <img src="{{ $item->picture !== null ? asset(Storage::url($item->picture)) : asset('storage/profiles/default.jpg') }}" alt="Imagen" class="accordion-list__card-image">
{{--                        <img src="{{ $item->picture !== null ? Storage::url($item->picture) : Storage::url('public/profiles/default.png') }}" alt="" class="accordion-list__card-image">--}}
                    @endif
                    <h5 class="accordion-list__card-title btn btn-link collapsed" data-toggle="collapse" data-target="#data-{{ $item->id }}" aria-expanded="false" aria-controls="{{ $item->id }}">
{{--                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#data-{{ $item->id }}" aria-expanded="false" aria-controls="{{ $item->id }}">--}}
                            {{ $item->name . ' ' . (isset($item->surnames) ? $item->surnames : '') }}
{{--                        </button>--}}
                    </h5>
                    <h6 class="accordion-list__card-subtitle">{{ $item->subtext }}</h6>
                    <p class="accordion-list__card-description">
                        @foreach($item->categories as $category)
                            {{ $category->name . ($loop->last ? '' : ', ') }}
                        @endforeach
                    </p>
                </div>

                <div id="data-{{ $item->id }}" class="collapse" aria-labelledby="item-{{ $loop->iteration }}" data-parent="#{{ isset($id) ? $id : 'accordion' }}">
                    <div class="accordion-list__card-body container">
                        @include( $body )
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if (isset($pagination))
        {!! $pagination !!}
    @endif
@else
    <div id="{{ isset($id) ? $id : 'accordion' }}" class="accordion-list accordion-list--empty">
        <div class="accordion-list__card">
            <p class="alert-message alert-message--empty-list">
                <i class="fas fa-wind"></i>
                <span>{{ __('component.media-cards.' . $id . '.not found') }}</span>
            </p>
        </div>
    </div>
@endif