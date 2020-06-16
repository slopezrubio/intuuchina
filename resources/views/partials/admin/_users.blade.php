<section class="content-tab">
    <div class="toolbox row">
        <div class="toolbox__tool col-12 col-md-7">
            @component('components.inputs.searchbox', ['action' => route('admin.users')])
                @slot('name', 'users')
            @endcomponent
        </div>
        <div class="toolbox__tool col-12 col-md-5 p-0 justify-content-md-end d-md-flex">
            @component('components.filter', ['filters' => App\Status::getFilter()])
                @slot('label', __('Status'))
                @slot('name', 'status')
            @endcomponent
        </div>
    </div>


    @component('components.accordion-list', ['items' => $data['users']])
        @slot('id', 'users')
        @slot('info', trans_choice('messages.items found', $data['users']->total(), ['value' => $data['users']->total(), 'name' => $data['users']->total() > 1 ? Str::plural('user') : 'user']))
        @slot('body', 'partials.forms.admin._users-list')
        @slot('pagination')
            {{ $data['users']->links('vendor.pagination.semantic-ui') }}
        @endslot
    @endcomponent
</section>
