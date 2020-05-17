<form action="{{ route('application.form') }}" class="card-form" method="POST">
    @csrf
    @component('components.inputs.hidden')
        @slot('name', 'category')
        @slot('value', $item->category)
    @endcomponent

    @component('components.inputs.hidden')
        @slot('name', 'program')
        @slot('value', 'inter_relocat')
    @endcomponent

    @component('components.inputs.cta-button')
        @slot('name', 'category')
        @slot('variant', 'primary')
        @slot('value', App\Category::find($item->category_id)->value)
        @slot('content', __('Apply For'))
    @endcomponent

    @component('components.inputs.cta-button')
        @slot('variant', 'primary')
        @slot('href', route('single-offer', ['offer' => $item->category_id]))
        @slot('content', __('Description'))
        @slot('value', App\Category::find($item->category_id)->value)
    @endcomponent
</form>

