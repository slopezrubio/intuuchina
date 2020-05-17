@if (isset($bag))
    <div class="c-switch-input flex-column flex-md-row align-items-start align-items-md-center{{ isset($errors) && $errors->$bag->has($name) ? ' is-invalid' : '' }}">
        <label for="{{ $bag . '-' . $name }}" class="c-switch-input__label w-75 w-md-auto">{!! $label !!}</label>
        <label for="{{ $bag . '-' . $name }}" class="form-control">
            <input id="{{ $bag . '-' . $name }}" class="form-control" name="{{ $name }}" type="checkbox">
            <i class="c-switch-input__wrapper wrapper fas"></i>
        </label>
    </div>
    @if (isset($errors) && $errors->$bag->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{!! $errors->$bag->first($name) !!}</strong>
        </span>
    @endif
@else
    <div class="c-switch-input flex-column flex-md-row align-items-start align-items-md-center{{ isset($errors) && $errors->has($name) ? ' is-invalid' : '' }}">
        <label for="{{ $name }}" class="c-switch-input__label w-75 w-md-auto">{!! $label !!}</label>
        <label for="{{ $name }}" class="form-control">
            <input id="{{ $name }}" class="form-control" name="{{ $name }}" type="checkbox">
            <i class="c-switch-input__wrapper wrapper fas"></i>
        </label>
    </div>
    @if (isset($errors) && $errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{!! $errors->first($name) !!}</strong>
        </span>
    @endif
@endif
