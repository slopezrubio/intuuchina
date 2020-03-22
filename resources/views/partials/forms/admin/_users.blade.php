
@component('components.inputs.searchbox', [
    'action' => route('admin.users')
])
    @slot('name', 'users')
@endcomponent

@component('components.accordion-list', [
    'items' => $data['users'],
])
    @slot('id', 'users')
    @slot('body', 'partials.forms.admin._users-list')
    @slot('pagination')
        {{ $data['users']->links('vendor.pagination.semantic-ui') }}
    @endslot
@endcomponent