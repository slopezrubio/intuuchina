
<div class="col-md-3">
    @component('components.inputs.label')
        @slot('name', $name . 'Filter')
        {{ $label }}
    @endcomponent
</div>

<div class="col-md-9">
    @component('components.inputs.select', ['options' => $filters])
        @slot('variant', 'gradient')
        @slot('id', $name . 'Filter')
        @slot('name', $name)
        @slot('value', isset($selected) ? $selected : 'default')
    @endcomponent
</div>
{{--<label for="{{ $name }}Filter" class="col-md-3 col-form-label text-md-left">{{ $label }}</label>--}}
{{--<div class="col-md-9">--}}
{{--    <div class="c-select-input c-select-input--gradient">--}}
{{--        <select autocomplete="off" id="{{ $name }}Filter" type="text" class="custom-select form-control" name="{{ $name }}[]" required>--}}
{{--            @foreach ($filters as $key => $filter)--}}
{{--                @if(isset($selected))--}}
{{--                    <option value="{{ $key }}" aria-selected="{{ $selected === $key ? 'true' : 'false' }}" {!! $selected === $key ? 'selected' : '' !!}>--}}
{{--                        {{ $filter }}--}}
{{--                    </option>--}}
{{--                @else--}}
{{--                    @if($loop->first)--}}
{{--                        <option value="default" selected aria-selected="true">{{ __('placeholder.filter.indefinite an', ['value' => ucfirst($name)]) }}</option>--}}
{{--                    @endif--}}
{{--                    <option value="{{ $key }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" {!! $loop->first ? 'selected' : '' !!}>--}}
{{--                        {{ $filter }}--}}
{{--                    </option>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--    </div>--}}
{{--</div>--}}