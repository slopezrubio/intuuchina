<label for="{{ $name }}" class="col-md-3 col-form-label text-md-left">{{ $label }}</label>
<div class="col-md-9">
    <input type="file" name="{{ $name }}" class="c-file-input form-control{{ $errors->has($name) || $errors->has('PostTooLargeException') ? ' is-invalid' : '' }}" id="{{ isset($bag) ? $bag . '-' . $name : $name }}">
    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @elseif($errors->has('PostTooLargeException'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('PostTooLargeException') }}</strong>
        </span>
    @else
        <small class="text-muted" role="alert">
            <strong>{{ $muted }}</strong>
        </small>
    @endif
</div>