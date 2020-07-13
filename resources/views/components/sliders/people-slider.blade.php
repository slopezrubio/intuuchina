<div class="people-slider">
    <div class="container">
        <h2 class="people-slider__title">{!! $title !!}</h2>
        @if(isset($people))
            <div class="people-slider__holder">
                <div class="people-slider__carousel">
                    @foreach($people as $person)
                        @if ($loop->index % 3 == 0 || $loop->index == 0)
                            <div class="people-slider__slide">
                        @endif
                        <div class="people-slider__item">
                            <img class="people-slider__item-avatar" src="{{ __('pictures.testimonial.url' , ['filepath' => str_replace('public', '', $person->avatar) ]) }}" alt="{{ __('pictures.testimonial.alt') }}">
                            <h6 class="people-slider__item-name">{{ $person->name .' '. $person->surnames }}</h6>
                            <strong class="people-slider__item-details">{{ $person->occupation }}</strong>
                            <p class="people-slider__item-quote">{{ $person->quotes->{(string) App::getLocale()} }}</p>
                        </div>
                        @if ($loop->iteration % 3 == 0)
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>