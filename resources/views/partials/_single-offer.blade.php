<main>
    @include('partials._breadcumb-section')
    <div class="container single-item">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10 col-xl-7">
                <section class="readable_section">
                    <h3 class="readable_section_title">{{ __('content.job description') }}</h3>
                    <p class="readable_section_body" id="jobDescription" data-html="{{ $offer->description }}"></p>
                </section>
                <section class="readable_section">
                    <h3 class="readable_section_title">{{ __('content.details') }}</h3>
                    <div class="card_background-image" data-content="/../../storage/images/details_{{$offer->location }}.jpg">
                        <div class="card_background-image_info">
                            <p class="card-title">{{ ucfirst($offer->location) }}</p>
                                <p class="card-text">Duration<span class="month"><strong class="month_value">{{ $offer->duration }}</strong>{{ $offer->duration != 1 ? ' Months' : ' Month'}}</span></p>
                        </div>
                    </div>
                </section>
                <section class="sendable_section">
                    <div class="offers_buttons">
                        @auth
                            @if(Auth::user()->type !== 'admin')
                                <button class="cta col-12 col-xs-5 col-sm-12 col-md-5 mt-0"><a href="#">{{ __('content.join also') }}</a></button>
                            @else
                                <button class="cta col-12 col-xs-5 col-sm-12 col-md-5 mt-0"><a href="{{ url('/admin/offers/edit/' . $offer->id) }}">{{ __('content.edit') }}</a></button>
                            @endif
                        @else
                            <button class="cta col-12 col-xs-5 col-sm-12 col-md-5 mt-0"><a href="{{ route('register') }}">{{ __('content.apply for') }}</a></button>
                        @endauth
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>