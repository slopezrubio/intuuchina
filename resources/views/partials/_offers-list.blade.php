<section id="content" class="container">
    <div class="toolbox col-12 px-0 px-md-3">
        <div class="toolbox__tool">
            @component('components.filter', ['filters' => App\Category::getFilter('inter_relocat')])
                @slot('label', __('Industry'))
                @slot('name', 'industry')
            @endcomponent
        </div>
    </div>

    @component('components.cards-list', ['items' => App\Offer::getCardList()])
        @slot('body')
            @include('partials.forms._card-offer')
        @endslot

        @slot('pagination')
            {{ $offers->links('vendor.pagination.semantic-ui') }}
        @endslot
    @endcomponent
</section>
