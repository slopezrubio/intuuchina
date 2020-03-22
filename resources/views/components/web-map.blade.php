<div class="web-map">
    @if(!empty(__('component.webmap.' . $name)))
        @foreach(__('component.webmap.' . $name) as $title => $section)
            @if(!empty($section))
                <div class="web-map__section">
                    <h4 class="web-map__title">
                        {{ $section['heading'] }}
                    </h4>
                    <ul class="web-map__list">
                        @foreach($section['options']() as $key => $item)
                            <li class="web-map__list-item">
                                @switch($item['method'])
                                    @case('POST')
                                        <form action="{{ $item['url'] }}">
                                            @csrf
                                            <input type="hidden" name="{{ $title }}" value="{{ $key }}">
                                            <a href="#">
                                                <button type="submit">{{ $item['text'] }}</button>
                                            </a>
                                        </form>
                                        @break
                                    @case('GET')
                                        <a href="{{ $item['url'] }}">
                                            {{ $item['text'] }}
                                        </a>
                                        @break
                                @endswitch
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    @endif
</div>