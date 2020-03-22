<section class="arrow-slider arrow-slider__holder">
    <div class="arrow-slider__carousel">
        @foreach (__('content.universities') as $key => $degree)
            @if (isset($slider))
                @switch($key)
                    @case($slider['next']['key'])
                        <div class="arrow-slider__slide--right">
                        @break
                    @case($slider['previous']['key'])
                        <div class="arrow-slider__slide--left">
                        @break
                    @case($slider['current']['key'])
                        <div class="arrow-slider__slide--current">
                        @break
                    @default
                        <div class="arrow-slider__slide">
                        @break
                @endswitch
            @else
                @if ($loop->first)
                    <div class="arrow-slider__slide--current">
                @elseif($loop->iteration == 2)
                    <div class="arrow-slider__slide--right">
                @else
                    <div class="arrow-slider__slide">
                @endif
            @endif
            <div class="arrow-slider__slide-header">
                <h2>{{ $degree['heading'] }}</h2>
                @auth
                    @if(Auth::user()->type === 'user')
                        @if (Auth::user()->program === 'university')
                            <form action="{{ route('update.program',  ['user' => Auth::user()->id, 'program' => Auth::user()->program]) }}" method="POST">
                                @csrf
                                <input type="hidden" value="university" name="program" id="program">
                                <input type="hidden" value="{{ $key }}" name="university">
                                <button type="submit" class="cta" name="product" value="university">{{ __('content.i\'m also interested') }}</button>
                            </form>
                        @else
                            <form action="{{ route('change.program', ['user' => Auth::user()->id ]) }}" method="POST">
                                @csrf
                                <input type="hidden" value="university" name="program" id="program">
                                <input type="hidden" value="{{ $key }}" name="degree">
                                <button type="submit" name="product" value="university" class="cta">{{ __('content.change preference') }}</button>
                            </form>
                        @endif
                    @endif
                @else
                    <form action="{{ route('application.form') }}" method="POST">
                        @csrf
                        <input type="hidden" value="university" name="program" id="program">
                        <input type="hidden" value="{{ $key }}" name="university">
                        <button type="submit" class="cta" name="product" value="university">{{ __('Apply For') }}</button>
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
        @foreach (__('content.universities') as $key => $degree)
            @if (isset($slider))
                <a href="#" class="{{ $key === $slider['current']['key'] ? 'selected' : '' }}"><span>{{ $degree['heading'] }}</span></a>
            @else
                <a href="#" class="{{ $key === array_key_first(__('content.universities')) ? 'selected' : '' }}"><span>{{ $degree['heading'] }}</span></a>
            @endif
        @endforeach
    </div>
</section>

