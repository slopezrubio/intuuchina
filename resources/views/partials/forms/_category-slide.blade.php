@auth
    @if(Auth::user()->type === 'user')
        <form action="{{ route('user.profile')}}">
            @csrf
            @component('components.inputs.cta-button')
                @slot('variant', 'tertiary')
                @slot('content', __('Change'))
            @endcomponent
        </form>
    @endif
@else
    <form action="{{ route('application.form') }}" method="POST">
        @csrf
        @component('components.inputs.cta-button')
            @slot('variant', 'tertiary')
            @slot('name', 'category')
            @slot('value', $slide->value)
            @slot('content', __('Apply For'))
        @endcomponent
    </form>
@endauth