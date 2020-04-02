<input type="hidden" id="{{ $name }}" name="{{ $name }}">
<div id="{{ $name }}-editor" {!! isset($placeholder) ? "data-value='" . $placeholder . "'" : '' !!} class="editor" {!! isset($delta) ? "data-html='" . $delta . "'" : '' !!}>
</div>

@if ($errors->has($name))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first($name) }}</strong>
    </span>
@endif