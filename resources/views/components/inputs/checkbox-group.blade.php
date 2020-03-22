<label for="input{{ $name }}" class="col-md-3 col-form-label text-md-left">{{ $label }}</label>
<div class="col-md-9">
    @foreach ($inputs as $key => $input)
        <div class="c-switch-input">
            <label class="c-switch-input__label" aria-label="{{ $key }}">{{ is_string($input) ? $input : $input['text'] }}</label>
            <label for="{{ $key }}">
                @auth
                    <input id="{{ $key }}" type="checkbox" value="{{ $key }}" name="{{ $name }}[]" aria-checked="{{ is_array(auth()->user()->$name) && in_array($key, auth()->user()->$name) ? 'true' : 'false' }}"
                           {!! is_array(auth()->user()->$name) && in_array($key, auth()->user()->$name) ? 'checked' : '' !!}/>
                @else
                    <input id="{{ $key }}" type="checkbox" value="{{ $key }}" name="{{ $name }}[]" aria-checked="{{ session()->has('preferences.'.$name) && session('preferences.'.$name) === $key ? 'true' : 'false' }}"
                            {!! session()->has('preferences.'.$name) && session('preferences.'.$name) === $key ? 'checked' : '' !!}/>
                @endauth
                <i class="c-switch-input__wrapper c-switch-input__wrapper--grouped wrapper fas"></i>
            </label>
        </div>
    @endforeach
</div>