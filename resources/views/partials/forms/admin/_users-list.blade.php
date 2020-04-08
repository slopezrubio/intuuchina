<div class="row">
    <ul class="col-12 col-sm-6">
        <li>
            <p>{{ $item->email }}</p>
        </li>
        <li>
            <p>{{ $item->phone_number }}</p>
        </li>
        @if(isset($item->created_at))
            @inject('carbon', "Illuminate\Support\Carbon")
            <li>
                <p>{{ __('Joined') . ' ' .$carbon->parse($item->created_at)->diffForHumans($carbon->now()) }}</p>
            </li>
        @endif
    </ul>
    <div class="row col-12 col-sm-6">
        <div class="col-12 col-sm-6 p-0">
            <button type="button" class="c-cta-button c-cta-button--primary">
                <a data-toggle="modal" data-target="#deleteUserModal" data-value="{{ $item->id }}">
                    {{ __('Delete') }}
                </a>
            </button>
        </div>
        <div class="col-12 col-sm-6 p-0">
            @component('components.inputs.cta-button', ['href' => route('admin.edit-user', ['id' => $item->id])])
                @slot('variant', 'primary')
                @slot('content', __('Edit'))
            @endcomponent
        </div>
    </div>
</div>

