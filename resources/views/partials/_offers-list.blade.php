<section id="content" class="container">
    <div class="toolbox col-12 px-0 px-md-3">
        <div class="toolbox__tool">
            @component('components.filter', ['filters' => __('component.filters.industry')])
                @slot('label', __('Industry'))
                @slot('name', 'industry')
            @endcomponent
        </div>
    </div>

    @component('components.cards-list', ['offers' => $offers])
        @slot('pagination')
            {{ $offers->links('vendor.pagination.semantic-ui') }}
        @endslot
    @endcomponent
</section>
