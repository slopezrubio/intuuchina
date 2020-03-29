<article>
    <h3>
        {{ __('Job Description') }}
    </h3>
    {!! $offer->getRenderedDescription() !!}
</article>
<article>
    <h3>{{ __('Details') }}</h3>
    @component('components.card-image')
        @slot('title', $offer->location)
        @slot('background', asset('storage/images/details_' . $offer->location . '.jpg'))
        @slot('content', [
            'text' => __('Duration'),
            'value' => $offer->duration,
            'unit' => trans_choice('content.months', $offer->duration)
        ])
    @endcomponent
</article>

@component('components.bottom-navigation')
    @slot('items', __('component.navs.bottom.job-description.items'))

    @auth
        @if(Auth::user()->type !== 'admin')
            @include('partials.user._single-offer')
        @endif
    @else
        @include('partials.forms._single-offer')
    @endauth
@endcomponent
