@component('components.banner')
    @if(Lang::has('content.done user.'.Auth::user()->categories->first()->value))
        @slot('text', __('content.done user.'.Auth::user()->categories->first()->value, ['program' => Auth::user()->program->name]))
    @else
        @slot('text', __('content.done user.default', ['program' => Auth::user()->program->name]))
    @endif
@endcomponent