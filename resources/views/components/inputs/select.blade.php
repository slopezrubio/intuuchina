
<div class="c-select-input{{ isset($variant) ? ' c-select-input--' . $variant : '' }}">
    <select autocomplete="off" id="{{ isset($id) ? $id : $name }}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{ $name }}" required>
        @foreach ($options as $k => $op)
            <option value="{{ strtolower($k) }}"{{
                old($name)
                    ?
                        (old($name) == $k || (isset($multiple) && $multiple && is_array(old($name)) && in_array($k, old($name))) ? ' selected="selected" aria-selected=true' : ' aria-selected=false')
                    :
                        (isset($value) && in_array($k, (array) $value) ? " selected=selected aria-selected=true" : " aria-selected=false")

            }}>{{ strip_tags($op) }}</option>
        @endforeach
    </select>
</div>
@if ($errors->has($name))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first($name) }}</strong>
    </span>
@endif