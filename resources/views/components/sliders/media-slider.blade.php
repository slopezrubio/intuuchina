<div class="media-slider">
    <div class="container">
        <h2 class="media-slider__title">{!! $title !!}</h2>
        @if(isset($media))
            <div class="media-slider__body">
                <div class="media-slider__holder">
                    <div class="media-slider__carousel">
                        @foreach($media as $key => $item)
                            <div class="media-slider__slide">
                                <a href="{{ $item['href'] }}" target="_blank">
                                    <img src="{{ asset('storage/images/content/' . $key . '.png') }}" alt="{{ trans('pictures.media-logo.alt', ['name' => preg_replace('/(_|-)/', ' ', Str::title($key))]) }}">
                                    <div class="media-slider__slide-content">
                                        <p>"{{ $item['quote'] }}"</p>
                                        <p>
                                            @if(isset($item['author']))
                                                <strong>{{ $item['author'] }}</strong><br/>
                                            @endif

                                            {{ $item['date'] }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <ul class="media-slider__controllers">
                    @foreach($media as $key => $item)
                        @if(!$loop->first)
                            <li>
                                <a href="#"><span class="helper"></span><img src="{{ asset('storage/images/content/' . $key . '.png') }}" alt="{{ trans('pictures.media-logo.alt', ['name' => preg_replace('/(_|-)/', ' ', Str::title($key))]) }}"></a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>