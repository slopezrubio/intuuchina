<article>
    <h3>
        {{ __('Job Description') }}
    </h3>

    @if($offer->hasDescription())
        {!! $offer->getRenderedDescription() !!}
    @else
        <p>{{ __('messages.resource not provided', ['resource' => ucfirst('description')]) }}</p>
    @endif
</article>
<article>
    <h3>{{ __('Details') }}</h3>
    @component('components.card-image')
        @slot('title', $offer->location)
        @slot('background', asset('storage/images/details_' . $offer->location . '.jpg'))
        @slot('content', [
            'text' => __('Duration'),
            'value' => $offer->duration,
            'unit' => Str::title(trans_choice('time.unit.month', $offer->duration)),
        ])
    @endcomponent
</article>

@auth
    @if(Auth::user()->type !== 'admin')
        @include('partials.forms.user._single-offer')
    @else
        @include('partials.forms.admin._single-offer')
    @endif
@else
    @include('partials.forms._single-offer')
@endauth
