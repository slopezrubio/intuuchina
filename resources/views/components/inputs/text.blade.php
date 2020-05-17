@if (isset($bag))
    <input id="{{ $bag . '-' . $name }}" type="{{ isset($type) ? $type : 'text' }}" class="c-text-input form-control{{ isset($errors) && $errors->$bag->has($name) ? ' is-invalid' : '' }}" name="{{ $name }}" {!! isset($placeholder) ? "placeholder='$placeholder'" : '' !!} value="{{ isset($value) ? $value : '' }}">
    @if (isset($errors) && $errors->$bag->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->$bag->first($name) }}</strong>
        </span>
    @endif
@else
    <input id="{{ $name }}" type="{{ isset($type) ? $type : 'text' }}" class="c-text-input form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{ $name }}" {!! isset($placeholder) ? "placeholder='$placeholder'" : '' !!} value="{{ isset($value) ? $value : '' }}">
    @if (isset($errors) && $errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
@endif
