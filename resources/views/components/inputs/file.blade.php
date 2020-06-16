@if(isset($preview))
    <img src="{{ $preview }}" alt="{{ __('Current uploaded picture') }}" class="c-file-input__img-preview">
@endif

@isset($bag)
    <input type="file" name="{{ $name }}" class="c-file-input form-control{{ $errors->$bag->has($name) || $errors->has('PostTooLargeException') ? ' is-invalid' : '' }}" id="{{ isset($id) ? $id : $name }}">
    @if ($errors->$bag->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->$bag->first($name) }}</strong>
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
@else
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
@endisset