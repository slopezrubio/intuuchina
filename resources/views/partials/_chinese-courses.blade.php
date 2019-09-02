<section class="course-descriptions">
    <div class="description-container">
        <div class="description-base">
            <div class="description-header">
                <h2 id="presencial">{!! trans('content.in-person course') !!}</h2>
                @auth
                    @if(Auth::user()->type !== 'admin')
                        <form action="#" method="POST">
                            @csrf
                            <input type="hidden" value="study" name="program" id="study">
                            <button type="submit" value="presencial" name="study" class="cta">{{ __('content.also interested') }}</button>
                        </form>
                    @endif
                @else
                    <form action="{{ route('register.options') }}" method="POST">
                        @csrf
                        <input type="hidden" value="study" name="program" id="study">
                        <button type="submit" value="presencial" name="study" class="cta">{{ __('content.apply for') }}</button>
                    </form>
                @endauth
            </div>
            <p>
                {{ __('content.courses')['online']['description'][0] }}
            </p>
        </div>
        <div class="description-base">
            <div class="description-header">
                <h2 id="online">{!! trans('content.online course') !!}</h2>
                @auth
                    @if(Auth::user()->type !== 'admin')
                    <form action="#" method="POST">
                        @csrf
                        <input type="hidden" value="study" name="program" id="study">
                        <button type="submit" value="online" name="study" class="cta">{{ __('content.also interested') }}</button>
                    </form>
                    @endif
                @else
                    <form action="{{ route('register.options') }}" method="POST">
                        @csrf
                        <input type="hidden" value="study" name="program" id="program">
                        <button type="submit" value="online" name="study" class="cta">{{ __('content.apply for') }}</button>
                    </form>
                @endauth
            </div>
            <p>
                {{ __('content.courses')['online']['description'][0] }}
            </p>
        </div>
    </div>
    <div class="description-options">
        @if ($params->currentCourse == 1)
            <a class="selected" href="#"><span>{{ __('links.in-person') }}</span></a>
        @else
            <a href="#"><span>{{ __('links.in-person') }}</span></a>
        @endif

        @if ($params->currentCourse == 2)
            <a class="selected" href="#"><span>{{ __('links.on-line') }}</span></a>
        @else
            <a href="#"><span>{{ __('links.on-line') }}</span></a>
        @endif
    </div>
</section>
@include('partials._price-course-info')