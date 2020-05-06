@if(isset($label))
    <label for="{{ Str::studly('input_' . $name) }}" class="col-md-3 col-form-label text-md-left">{{ $label }}</label>
@endif

<div class="radio-chips radio-chips__container col-12{{ isset($label) ? ' col-sm-6' : '' }}">
    @foreach($inputs as $input)
        <div class="radio-chips__item">
            <input type="radio" class="radio-chips__item-input" value="{{ $input['value'] }}" name="{{ $name }}" id="{{ $name . '-' . $input['id'] }}"
                    {!! in_array($input['value'], $checked) ? 'checked' : '' !!}>
            <label data-icon="{{ $input['icon'] }}" for="{{ $name . '-' . $input['id'] }}" class="radio-chips__item-label">
                <span>{{ $input['name'] }}</span>
            </label>
        </div>
    @endforeach
</div>