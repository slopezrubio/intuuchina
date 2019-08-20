<section class="course-descriptions">
    <div class="description-container">
        <div class="description-base">
            <div class="description-header">
                <h2 id="presencial">{{ __('content.in-person course')[0] }}<span>{{ __('content.in-person course')[1] }}</span></h2>
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
                @if (App::getLocale() == 'en')
                    <h2 id="online"><span>{{ __('content.online course')[0] }} </span>{{ __('content.online course')[1] }}</h2>
                @elseif(App::getLocale() == 'es')
                    <h2 id="online">{{ __('content.online course')[1] }} <span>{{ __('content.online course')[0] }}</span></h2>
                @endif

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
                        <input type="hidden" value="study" name="program" id="study">
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