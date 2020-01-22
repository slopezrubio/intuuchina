<section class="people-slider">
    <div class="container">
        <h2 class="people-slider__title">{!! trans('content.those who have already tried it') !!}</h2>
        @if(isset($testimonials))
            <div class="people-slider__holder">
                <div class="people-slider__carousel">
                    @foreach($testimonials as $testimonial)
                        @if ($loop->index % 3 == 0)
                            <div class="people-slider__slide">
                        @endif
                            <div class="people-slider__item">
                                <img class="people-slider__item-avatar" src="{{ Storage::url($testimonial->avatar) }}" alt="{{ __('pictures.testimonials.alt') }}">
                                <h6 class="people-slider__item-name">{{ $testimonial->name .' '. $testimonial->surnames }}</h6>
                                <strong class="people-slider__item-details">{{ $testimonial->occupation }}</strong>
                                <p class="people-slider__item-quote">{{ $testimonial->quotes->{(string) App::getLocale()} }}</p>
                            </div>
                        @if ($loop->iteration === 3)
                            </div>
                        @endif
                    @endforeach
                        @foreach($testimonials as $testimonial)
                            @if ($loop->index % 3 == 0)
                                <div class="people-slider__slide">
                                    @endif
                                    <div class="people-slider__item">
                                        <img class="people-slider__item-avatar" src="{{ Storage::url($testimonial->avatar) }}" alt="{{ __('pictures.testimonials.alt') }}">
                                        <h6 class="people-slider__item-name">{{ $testimonial->name .' '. $testimonial->surnames }}</h6>
                                        <strong class="people-slider__item-details">{{ $testimonial->occupation }}</strong>
                                        <p class="people-slider__item-quote">{{ $testimonial->quotes->{(string) App::getLocale()} }}</p>
                                    </div>
                                    @if ($loop->iteration === 3)
                                </div>
                            @endif
                        @endforeach
                </div>
            </div>
        @endif
    </div>
</section>