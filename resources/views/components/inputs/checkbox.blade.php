<div class="col-md-12">
    <div class="c-checkbox-input {{isset($variant) ? 'c-checkbox-input--' . $variant : ''}} flex-column flex-md-row align-items-start align-items-md-center">
        <label for="{{ isset($bag) ? $bag . '-' . $name : $name }}" class="c-checkbox-input__label w-75 w-md-auto">{!! $label !!}</label>
        <label for="{{ isset($bag) ? $bag . '-' . $name : $name }}" class="form-control{{ $errors->has(isset($bag) ? $bag . '-' . $name : $name) ? ' is-invalid' : '' }}">
            <input id="{{ isset($bag) ? $bag . '-' . $name : $name }}" class="form-control" name="{{ $name }}" type="checkbox">
            <i class="c-checkbox-input__wrapper wrapper fas"></i>
        </label>
    </div>
    @if (isset($bag))
        <span class="invalid-feedback" role="alert">
            <strong>{!! $errors->$bag->first($name) !!}</strong>
        </span>
    @else
        <span class="invalid-feedback" role="alert">
            <strong>{!! $errors->first($name) !!}</strong>
        </span>
    @endif
</div>