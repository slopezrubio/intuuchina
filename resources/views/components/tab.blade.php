@if(isset($tabs))
    <ul class="nav nav-tabs" id="{{ $id . '-tab' }}" role="tablist">
        @foreach($tabs as $key => $tab)
            <li class="nav-item">
                @if (isset($selected))
                    <a class="nav-link {{ $selected === $key ? 'active' : '' }}" id="{{ $key . '-tab' }}" data-toggle="tab" href="{{ '#' . $key . '-content-tab' }}" aria-controls="{{ $key }}" aria-selected="false">
                        @if (array_key_exists('icon', $tab))
                            <i class="{{ $tab['icon'] }}"></i>
                        @endif
                        <span>{{ $tab['text'] }}</span>
                    </a>
                @else
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $key . '-tab' }}" data-toggle="tab" href="{{ '#' . $key . '-content-tab' }}" aria-controls="{{ $key }}" aria-selected="false">
                        @if (array_key_exists('icon', $tab))
                            <i class="{{ $tab['icon'] }}"></i>
                        @endif
                        <span>{{ $tab['text'] }}</span>
                    </a>
                @endif
            </li>
        @endforeach
    </ul>
    <div class="tab-content position-relative" style="">
        @foreach($tabs as $key => $tab)
            @if (isset($selected))
                <div class="tab-pane fade{{ $selected === $key ? ' show active' : '' }}" id="{{ $key . '-content-tab' }}" role="tabpanel" aria-labelledby="{{ $key . '-tab' }}">
                    @include($tab['content'])
                </div>
            @else
                <div class="tab-pane fade{{  $loop->first ? ' show active' : '' }}" id="{{ $key . '-content-tab' }}" role="tabpanel" aria-labelledby="{{ $key . '-tab' }}">
                    @include($tab['content'])
                </div>
            @endif
        @endforeach
    </div>
@endif