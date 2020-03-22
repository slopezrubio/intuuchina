@if(isset($items) && $items->total() > 0)
    <div id="{{ isset($id) ? $id : 'accordion' }}" class="accordion-list">
        @foreach($items as $key => $item)
            <div class="card accordion-list__card">
                <div class="card-header accordion-list__card-header" id="heading-{{ $loop->iteration }}">
                    @if(property_exists($item, 'picture'))
                        <img src="{{ $item->picture !== null ? Storage::url($item->picture) : Storage::url('public/profiles/default.png') }}" alt="" class="accordion-list__card-image">
                    @endif
                    <h5 class="mb-0 accordion-list__card-title">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#data-{{ $item->id }}" aria-expanded="false" aria-controls="{{ $item->id }}">
                            {{ $item->name . ' ' . (isset($item->surnames) ? $item->surnames : '') }}
                        </button>
                    </h5>
                    <h6 class="accordion-list__card-subtitle">{{ __('content.programs.' . $item->subtext) }}</h6>
                    <p>
                        @if(isset($item->{$item->subtext}) && is_array($item->{$item->subtext}))
                            @foreach($item->{$item->subtext} as $subitem)
                                {{ $subitem . ($loop->last ? '' : ', ') }}
                            @endforeach
                        @elseif(isset($item->{$item->subtext}))
                            @foreach(json_decode($item->{$item->subtext}) as $subitem)
                                {{ __('content.industries.' . $subitem) . ($loop->last ? '' : ', ') }}
                            @endforeach
                        @endif
                    </p>
                </div>

                <div id="data-{{ $item->id }}" class="collapse" aria-labelledby="item-{{ $loop->iteration }}" data-parent="#{{ isset($id) ? $id : 'accordion' }}">
                    <div class="accordion-list__card-body card-body">
                        @include($body)
                    </div>
                </div>
            </div>
        @endforeach
    </div>
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

@if (isset($pagination))
    {!! $pagination !!}
@endif