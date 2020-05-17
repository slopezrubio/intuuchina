{{--<section class="arrow-slider arrow-slider__holder"  id="{{ isset($slider) ? $slider['current']['key'] :  key(__('content.courses'))}}">--}}
{{--    <div class="arrow-slider__carousel">--}}
{{--        @foreach (App\Program::where('value', 'study')->first()->studies as $key => $study)--}}
{{--            @if (isset($slider))--}}
{{--                @switch($key)--}}
{{--                    @case($slider['next']['key'])--}}
{{--                        <div class="arrow-slider__slide--right">--}}
{{--                        @break--}}
{{--                    @case($slider['previous']['key'])--}}
{{--                        <div class="arrow-slider__slide--left">--}}
{{--                        @break--}}
{{--                    @case($slider['current']['key'])--}}
{{--                        <div class="arrow-slider__slide--current">--}}
{{--                        @break--}}
{{--                    @default--}}
{{--                        <div class="arrow-slider__slide">--}}
{{--                        @break--}}
{{--                @endswitch--}}
{{--            @else--}}
{{--                @if ($loop->first)--}}
{{--                    <div class="arrow-slider__slide--current">--}}
{{--                @endif--}}

{{--                @if ($loop->iteration === 2)--}}
{{--                    <div class="arrow-slider__slide--right">--}}
{{--                @endif--}}
{{--            @endif--}}
{{--            <div class="arrow-slider__slide-header">--}}
{{--                <h2>{{ $course['text'] }} {!! $course['slider'] !!}</h2>--}}
{{--                @auth--}}
{{--                    @if(Auth::user()->type === 'user')--}}
{{--                        @if (Auth::user()->program === 'study')--}}
{{--                            @if (array_key_exists($key, Auth::user()->getStudies()))--}}
{{--                                <p>You are already interested in this service</p>--}}
{{--                            @else--}}
{{--                                <form action="{{ route('update.program', ['user' => Auth::user()->id, 'program' => Auth::user()->program]) }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" value="study" name="program">--}}
{{--                                    <input type="hidden" value="{{ $key }}" name="course" id="study">--}}
{{--                                    <button type="submit" name="product" value="study" class="cta">{{ __('I\'m Also Interested') }}</button>--}}
{{--                                </form>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <form action="{{ route('change.program', ['user' => Auth::user()->id ]) }}" method="POST">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" value="study" name="program" id="program">--}}
{{--                                <input type="hidden" value="{{ $key }}" name="course">--}}
{{--                                <button type="submit" name="product" value="study" class="cta">{{ __('Change Preference') }}</button>--}}
{{--                            </form>--}}
{{--                        @endif--}}
{{--                    @endif--}}
{{--                @else--}}
{{--                    <form action="{{ route('application.form') }}" method="POST">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" value="study" name="program" id="program">--}}
{{--                        <input type="hidden" value="{{ $key }}" name="study">--}}
{{--                        <button type="submit" class="cta" name="product" value="study">{{ __('Apply For') }}</button>--}}
{{--                    </form>--}}
{{--                @endauth--}}
{{--            </div>--}}
{{--            <p>--}}
{{--                {{ $course['description'] }}--}}
{{--            </p>--}}
{{--        </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--    <div class="arrow-slider__controllers">--}}
{{--        @foreach (__('content.courses') as $key => $course)--}}
{{--            @if (isset($slider))--}}
{{--                <a href="#{{ $key }}" class="{{ $key === $slider['current']['key'] ? 'selected' : '' }}"><span>{{ $course['text'] }}</span></a>--}}
{{--            @else--}}
{{--                <a href="#{{ $key }}" class="{{ $key === array_key_first(__('content.courses')) ? 'selected' : '' }}"><span>{{ $course['text'] }}</span></a>--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--</section>--}}
