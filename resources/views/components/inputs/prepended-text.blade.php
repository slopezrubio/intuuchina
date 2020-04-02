<div class="col-12 p-0 input-group-prepend">
    <div class="col-7 p-0">
        <input id="{{ $name }}" type="{{ isset($type) ? $type : 'text' }}" class="c-text-input form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{ $name }}" {!! isset($placeholder) ? "placeholder='$placeholder'" : '' !!} value="{{ isset($value) ? $value : '' }}">
    </div>
    <div class="col-5 p-0 input-group-text justify-content-center">
        {{ $slot }}
    </div>
</div>

<div class="col-12 p-0">
    <input type="hidden" class="{{ $errors->has($name) ? ' is-invalid' : '' }}">
    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>