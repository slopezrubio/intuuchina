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

{{--<section class="main-section--primary">--}}
{{--    <div class="title-card col-10 col-xs-10 col-sm-10 col-md-8 ">--}}
{{--        @if (Request::is('/'))--}}
{{--            <button class="cta col-10 col-xs-10 col-sm-8 col-md-8 col-lg-4">--}}
{{--                <a href="{{ route('internship') }}">{{ __('content.see job offers') }}--}}
{{--                    <i class="fas fa-chevron-right"></i>--}}
{{--                </a>--}}
{{--            </button>--}}
{{--        @endif--}}

{{--        @if(array_key_exists($view_name, __("page-titles")) )--}}
{{--            <h1 class="title-card-title">{!!  __('page-titles.' . $view_name) !!}</h1>--}}
{{--        @endif--}}

{{--        @if (isset($offer))--}}
{{--            <h1 class="title-card-title">{{  __('content.industries.'. $offer->industry) }}</h1>--}}
{{--            <h2 class="title-card-subtitle">{{ $offer->title }}</h2>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</section>--}}