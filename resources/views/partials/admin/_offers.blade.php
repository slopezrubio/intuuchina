<section class="content-tab">
    <div class="toolbox row">
        <div class="toolbox__tool col-8 col-sm-9">
            @component('components.inputs.searchbox', ['action' => route('admin.offers')])
                @slot('name', 'offers')
            @endcomponent
        </div>
        <div class="toolbox__tool col-4 offset-1 offset-sm-0 col-sm-3">
            @component('components.inputs.cta-button')
                @slot('variant', 'primary')
                @slot('href',  route('admin.new-offer'))
                @slot('content', __('New'))
                @slot('fas', 'plus')
            @endcomponent
        </div>
    </div>

    @component('components.media-cards', ['items' => $data['offers']])
        @slot('id', 'offers')
        @slot('action', 'partials.forms.admin._offers-list')
        @slot('pagination')
            {{ $data['offers']->links('vendor.pagination.semantic-ui') }}
        @endslot
    @endcomponent
</section>

