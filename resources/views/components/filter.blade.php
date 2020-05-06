
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