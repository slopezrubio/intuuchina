<label for="{{ Str::studly('input_' . $name) }}" class="col-md-3 col-form-label text-md-left">{{ $label }}</label>
<div class="container col-md-9">
    <div class="row">
        @foreach ($inputs as $input)
            @if($loop->index % 3 == 0 || $loop->first)
                <div class="col-12 col-sm-6">
            @endif
                <div class="c-switch-input">
                    <label class="c-switch-input__label" aria-label="{{ $input['id'] }}">{{ is_string($input) ? $input : $input['name'] }}</label>
                    <label for="{{ $input['id'] }}">
                            <input id="{{ $input['id'] }}" type="checkbox" {!! isset($input['value']) ? 'value='.$input['value'] : '' !!} name="{{ $name }}[]" aria-checked="{{ in_array($input['id'], $checked) ? 'true' : 'false' }}"
                                    {!! in_array($input['id'], $checked) ? 'checked' : '' !!}/>
                        <i class="c-switch-input__wrapper c-switch-input__wrapper--grouped wrapper fas"></i>
                    </label>
                </div>

            @if((($loop->index + 1) % 3 == 0 && !$loop->first) || $loop->last)
                </div>
            @endif

        @endforeach
    </div>
</div>