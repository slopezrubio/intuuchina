@component('components.banner')
    @if(Lang::has('content.placed user.'.Auth::user()->categories->first()->value, null, false))
        @slot('text', __('content.placed user.'.Auth::user()->categories->first()->value, ['program' => Auth::user()->program->name]))
    @else
        @slot('text', __('content.placed user.default', ['program' => Auth::user()->program->name]))
    @endif
@endcomponent