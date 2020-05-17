<div class="row">
    <div class="col-12 col-sm-6">
        <button type="button" class="c-cta-button c-cta-button--primary">
            <a data-toggle="modal" data-target="#deleteFeeModal" data-value="{{ $item->id }}">
                {{ __('Delete') }}
                <i class="fas fa-trash-alt"></i>
            </a>
        </button>
    </div>
    <div class="col-12 col-sm-6">
        @component('components.inputs.cta-button', [
            'href' => route('admin.edit-fee', ['id' => $item->id])
        ])
            @slot('variant', 'primary')
            @slot('content', __('Edit'))
            @slot('fas', 'pencil-alt')
        @endcomponent
    </div>
</div>