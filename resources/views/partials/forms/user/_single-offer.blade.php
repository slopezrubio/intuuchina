@component('components.bottom-navigation')
    @slot('action')
        <form class="card-form" action="{{ route('user.profile') }}">
            @csrf
            @component('components.inputs.cta-button')
                @slot('variant', 'primary')
                @slot('content', __('Apply For'))
            @endcomponent
        </form>
    @endslot
@endcomponent