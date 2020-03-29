@component('components.inputs.searchbox', [
    'action' => route('admin.offers')
])
    @slot('name', 'offers')
@endcomponent

@component('components.modal', [
    'name' => 'deleteOffer',
    'title' => $data['offers']->first()->id
])
    @include('partials.forms.admin._delete-item')
@endcomponent

@component('components.media-cards', [
    'items' => $data['offers'],
])
    @slot('id', 'offers')
    @slot('action', 'partials.forms.admin._offers-list')
    @slot('pagination')
        {{ $data['offers']->links('vendor.pagination.semantic-ui') }}
    @endslot
@endcomponent