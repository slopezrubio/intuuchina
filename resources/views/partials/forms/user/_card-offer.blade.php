<form action="{{ route('user.profile') }}" class="card-form">
    @csrf
    @component('components.inputs.cta-button')
        @slot('variant', 'primary')
        @slot('content', __('Change'))
    @endcomponent

    @component('components.inputs.cta-button')
        @slot('variant', 'primary')
        @slot('href', route('single-offer', ['offer' => $item->category_id]))
        @slot('content', __('Description'))
        @slot('value', App\Category::find($item->category_id)->value)
    @endcomponent
</form>