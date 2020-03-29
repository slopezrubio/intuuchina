<form class="card-form" action="{{ route('application.form') }}">
    @csrf
    @component('components.inputs.hidden')
        @slot('name', 'program')
        @slot('value', 'industry')
    @endcomponent

    @component('components.inputs.hidden')
        @slot('name', 'industry')
        @slot('value', $offer->industry)
    @endcomponent

    @component('components.inputs.cta-button')
        @slot('variant', 'primary')
        @slot('content', __('Apply For'))
    @endcomponent
</form>