<header class="{{ isset($variant) ? $variant : '' }}" style="background-image: {{ isset($background_image) ? 'url(' .$background_image. ')' : 'none' }}">
    @include('partials._nav')

    <section class="wrapper">
        <div class="header-box col-10 col-md-8">
            @if (isset($cta))
                <button class="cta col-10 col-md-8 col-lg-4">
                    <a href="{{ $href }}">{{ $cta }}
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </button>
            @endif

            @if (isset($title))
                <h1 class="header-box__title">{!! $title !!}</h1>
            @endif

            @if (isset($subtitle))
                <h2 class="header-box__subtitle">{{ $subtitle }}</h2>
            @endif
        </div>
    </section>
</header>