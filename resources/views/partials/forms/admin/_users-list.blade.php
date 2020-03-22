<form class="row" action="{{ route('admin.delete-user', ['id' => $item->id]) }}" method="POST">
    <ul>
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
            'href' => route('admin.edit-user', ['id' => $item->id])
        ])
            @slot('variant', 'primary')
            @slot('content', __('Edit'))
        @endcomponent
    </div>
</form>

