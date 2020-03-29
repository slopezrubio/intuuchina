<form class="card-form" action="{{ route('update.program', [
    'user' => Auth::user()->id,
    'program' => Auth::user()->program
]) }}">

    @csrf
    @component('components.inputs.hidden')
        @slot('name', 'program')
        @slot('value', 'industry')
    @endcomponent

    @component('components.inputs.hidden')
        @slot('name', 'industry')
        @slot('value', $offer->industry)
    @endcomponent


    @switch(Auth::user()->program)
        @case('internship')
        @case('inter_relocat')
            @if(!array_key_exists($offer->industry, Auth::user()->industry))
                @component('components.inputs.cta-button')
                    @slot('content', Auth::user()->industry === null ? __('Apply For') : __('Add Preference'))
                    @slot('value', 'inter_relocat')
                @endcomponent
            @endif
            @break
        @default
            @component('components.inputs.cta-button')
                @slot('content', __('Change Preference'))
            @endcomponent
            @break
    @endswitch
</form>