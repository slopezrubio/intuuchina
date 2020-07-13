@component('components.bottom-navigation')
    @slot('action')
        <form class="card-form" action="{{ route('admin.edit-offer', ['offer' => $offer->id]) }}">
            @csrf
            @component('components.inputs.cta-button')
                @slot('variant', 'primary')
                @slot('content', __('Edit'))
            @endcomponent
        </form>
    @endslot
@endcomponent