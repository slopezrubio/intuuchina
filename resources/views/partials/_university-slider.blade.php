<section class="arrow-slider arrow-slider__holder">
    <div class="arrow-slider__carousel">
        @foreach (__('content.universities') as $key => $degree)
            <div class="arrow-slider__slide">
                <div class="arrow-slider__slide-header">
                    <h2>{{ $degree['heading'] }}</h2>
                    @auth
                        @if(Auth::user()->type !== 'admin')
                            <form action="#" method="POST">
                                @csrf
                                <input type="hidden" value="university" name="program" id="study">
                                <button type="submit" value="{{ $key }}" name="university" class="cta">{{ __('content.also interested') }}</button>
                            </form>
                        @endif
                    @else
                        <form action="{{ route('register.options') }}" method="POST">
                            @csrf
                            <input type="hidden" value="university" name="program" id="study">
                            <button type="submit" value="{{ $key }}" name="study" class="cta">{{ __('content.apply for') }}</button>
                        </form>
                    @endauth
                </div>
                <p>
                    {{ $degree['description'] }}
                </p>
            </div>
        @endforeach
    </div>
    <div class="arrow-slider__controllers">
        @foreach(__('content.universities') as $key => $degree)
            @if($loop->first)
                <a class="selected" href="#"><span>{{ $degree['heading'] }}</span></a>
            @else
                <a href="#"><span>{{ $degree['heading'] }}</span></a>
            @endif
        @endforeach
    </div>
</section>
