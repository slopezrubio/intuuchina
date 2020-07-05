<form action="{{ route('user.profile') }}" class="card-form">
    @csrf
    @component('components.inputs.cta-button')
        @slot('variant', 'primary')
        @slot('content', __('Apply For'))
    @endcomponent

    @component('components.inputs.cta-button')
        @slot('variant', 'primary')
        @slot('href', route('single-offer', ['offer' => $item->id]))
        @slot('content', __('Description'))
    @endcomponent
</form>