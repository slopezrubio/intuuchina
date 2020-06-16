@component('components.bottom-navigation')
    @slot('action')
        <form class="card-form" action="{{ route('application.form') }}" method="POST">
            @csrf

            @component('components.inputs.hidden')
                @slot('name', 'program')
                @slot('value', 'inter_relocat')
            @endcomponent

            @component('components.inputs.cta-button')
                @slot('name', 'category')
                @slot('variant', 'primary')
                @slot('value', $offer->category->value)
                @slot('content', __('Apply For'))
            @endcomponent
        </form>
    @endslot
@endcomponent