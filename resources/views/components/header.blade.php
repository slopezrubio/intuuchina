<header class="{{ isset($variant) ? $variant : '' }}" style="background-image: {{ isset($background_image) ? 'url(' .$background_image. ')' : 'none' }}">
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

    @if(isset($dialog))
        @include('partials.dialogs' . isset($dir) ? $dir.'.' : '.' . $dialog)
    @endif
</header>