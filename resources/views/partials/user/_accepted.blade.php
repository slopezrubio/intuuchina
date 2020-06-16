@component('components.banner')
    @slot('variant', 'success')
    @slot('text', trans('content.accepted user', ['program' => Auth::user()->program->name]))
@endcomponent