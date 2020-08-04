@auth
    @if(Auth::user()->type === 'user')
        <form action="{{ route('user.profile')}}">
            @csrf
            @component('components.inputs.hidden')
                @slot('name', 'category')
                @slot('value', $slide->value)
            @endcomponent

            @component('components.inputs.cta-button')
                @slot('variant', 'tertiary')
                @slot('content', __('Apply'))
            @endcomponent
        </form>
    @elseif(Auth::user()->type === 'admin')
        @component('components.inputs.hidden')
            @slot('name', 'category')
            @slot('value', $slide->value)
        @endcomponent
    @endif
@else
    <form action="{{ route('application.form') }}" method="POST">
        @csrf
        @component('components.inputs.hidden')
            @slot('name', 'category')
            @slot('value', $slide->value)
        @endcomponent

        @component('components.inputs.cta-button')
            @slot('variant', 'tertiary')
            @slot('content', __('Apply'))
        @endcomponent
    </form>
@endauth