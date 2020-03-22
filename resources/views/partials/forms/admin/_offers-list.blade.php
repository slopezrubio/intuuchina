<form class="row" action="{{ route('admin.delete-offer', ['id' => $item->id]) }}" method="POST">
    <p>
        {{ $item->description }}
    </p>
    <h6 class="text-uppercase letter-spacing letter-spacing--location">{{ $item->location }}</h6>
    @method('DELETE')
    @csrf
    <div class="col-12 col-sm-6">
        @component('components.inputs.cta-button')
            @slot('variant', 'primary')
            @slot('content', __('Delete'))
        @endcomponent
    </div>
    <div class="col-12 col-sm-6">
        @component('components.inputs.cta-button', [
            'href' => route('admin.edit-offer', ['id' => $item->id])
        ])
            @slot('variant', 'primary')
            @slot('content', __('Edit'))
        @endcomponent
    </div>
</form>