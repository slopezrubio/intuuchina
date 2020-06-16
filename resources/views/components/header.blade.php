<header class="{{ isset($variant) ? $variant : '' }}" style="background-image: {{ isset($header['background']) ? 'url(' .$header['background']. ')' : 'none' }}">
    @include('partials._nav')

    @if(isset($header['title']) || key_exists('title', $header))
        <section class="wrapper">
            <div class="header-box col-10 col-md-8 align-items-center">
                @if (isset($input))
                    <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                        @component('components.inputs.' . $input['name'])
                            @if(isset($input['href']))
                                @slot('href', $input['href'])
                            @endif

                            @slot('variant', $input['variant'])
                            @slot('content', $input['content'])

                            @if(isset($input['fas']))
                                @slot('fas', $input['fas'])
                            @endif

                            @if(isset($input['fab']))
                                @slot('fab', $input['fab'])
                            @endif
                        @endcomponent
                    </div>
                @endif

                <h1 class="header-box__title">{!! $header['title'] !!}</h1>

                @if (isset($header['subtitle']) || key_exists('subtitle', $header))
                    <h2 class="header-box__subtitle">{{ $header['subtitle'] }}</h2>
                @endif
            </div>
        </section>
    @endif

    @if(isset($header['error-message']) || key_exists('error-message', $header))
        <section class="wrapper">
            <div class="row">
                <div class="error-found__box col-12 col-md-8">
                    <h1 class="error-found__box-title">{!! $header['error-message'] !!}</h1>
                </div>
            </div>
            <div class="row">
                <div class="error-found__info col-12 col-md-8">
                    <p>{!! __('content.are you in doubt') !!}</p>
                </div>
            </div>
            <div class="row">
                <div class="error-found__action col-6 col-md-4 col-lg-2">
                    @component('components.inputs.cta-button')
                        @slot('variant', 'secondary')
                        @slot('content', __('Back'))
                        @slot('href', url()->previous())
                    @endcomponent
                </div>
            </div>

            @isset($card)
                @component('components.curiosity-card', ['card' => $card])
                @endcomponent
            @endisset
        </section>


    @endif

    @if($variant === 'stats')
        @foreach($header['stats'] as $stat)
            @if ($loop->index % 3 == 0)
                <section class="stats__container">
            @endif

            <article class="stats__item">
                {!! $stat !!}
            </article>

            @if ($loop->iteration === 3)
                </section>
            @endif
        @endforeach
    @endif

    @if(isset($dialog))
        @include($dialog)
    @endif
</header>
