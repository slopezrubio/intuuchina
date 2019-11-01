<section class="main-section--primary">
    <div class="title-card col-10 col-xs-10 col-sm-10 col-md-8 ">
        @if (Request::is('/'))
            <button class="cta col-10 col-xs-10 col-sm-8 col-md-8 col-lg-4">
                <a href="{{ route('offers') }}">{{ __('content.see job offers') }}
                    <i class="fas fa-chevron-right"></i>
                </a>
            </button>
        @endif

        @if( array_key_exists($view_name, __("page-titles")) )
            <h1 class="title-card-title">{!!  __('page-titles.' . $view_name) !!}</h1>
        @endif

        @if (Route::current()->getName() === 'single-offer')
            @if (isset($offer))
                <h1 class="title-card-title">{!!  $offer->industry !!}</h1>
                <h2 class="title-card-subtitle">{{ $offer->title }}</h2>
            @endif
        @endif
    </div>
</section>
