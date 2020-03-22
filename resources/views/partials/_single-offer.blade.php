
<section class="readable_section">
    <h3 class="readable_section_title">{{ __('Job Description') }}</h3>
    <p class="readable_section_body" id="jobDescription" data-html="{{ $offer->description }}"></p>
</section>
<section class="readable_section">
    <h3 class="readable_section_title">{{ __('Details') }}</h3>
    <div class="card_background-image" data-content="/../../storage/images/details_{{$offer->location }}.jpg">
        <div class="card_background-image_info">
            <p class="card-title">{{ ucfirst($offer->location) }}</p>
            <p class="card-text">Duration<span class="month"><strong class="month_value">{{ $offer->duration }}</strong>{{ $offer->duration != 1 ? ' Months' : ' Month'}}</span></p>
        </div>
    </div>
</section>
<section class="sendable_section">
    @auth
        @if(Auth::user()->type !== 'admin')
            <form class="card-form text-center py-3" action="{{ route('change.program', ['user' => Auth::user()->id ]) }}" method="POST">
                @csrf
                <input type="hidden" value="{{ Auth::user()->program }}" name="program">
                <input type="hidden" value="{{ $offer->industry }}" name="industry">
                <button class="cta col-12 col-xs-5 col-sm-12 col-md-5 mt-0"><a href="/internship/{{ $offer->id }}">{{ __('Description') }}</a></button>
            </form>
        @endif
    @else
        <form class="card-form text-center py-3" id="#applyJob" action="{{ route('application.form') }}" method="POST">
            @csrf
            <input type="hidden" value="inter_relocat" name="program" id="program">
            <input type="hidden" value="{{ $offer->industry }}" name="inter_relocat">
            <button class="cta col-8 col-md-5 mt-0" type="submit" value="industry" name="product">{{ __('Apply For') }}</button>
        </form>
    @endauth
</section>
