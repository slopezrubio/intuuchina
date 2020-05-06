<div class="row align-items-sm-center">
    <ul class="col-12 col-sm-6 col-xl-12">
        <li>
            {{ $item->email }}
        </li>
        <li>
            {{ $item->phone_number }}
        </li>
        @if(isset($item->created_at))
            @inject('carbon', "Illuminate\Support\Carbon")
            <li>
                {{ __('Joined') . ' ' .$carbon->parse($item->created_at)->diffForHumans($carbon->now()) }}
            </li>
        @endif
    </ul>
    <div class="col-12 col-sm-6 col-xl-12 container">
        <div class="row flex-column flex-sm-row">
            <div class="col-12 col-md-6 col-lg-12 mt-3 mt-sm-0 mt-xl-3">
                <button type="button" class="c-cta-button c-cta-button--primary">
                    <a data-toggle="modal" data-target="#deleteUserModal" data-value="{{ $item->id }}">
                        {{ __('Delete') }}
                    </a>
                </button>
            </div>
            <div class="col-12 col-md-6 col-lg-12 mt-2 mt-md-0 mt-lg-2">
                @component('components.inputs.cta-button', ['href' => route('admin.edit-user', ['id' => $item->id])])
                    @slot('variant', 'primary')
                    @slot('content', __('Edit'))
                @endcomponent
            </div>
        </div>
    </div>
</div>

