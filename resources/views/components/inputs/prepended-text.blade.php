<div class="col-12 p-0 input-group-prepend">
    <div class="col-7 p-0">
        @component('components.inputs.text')
            @slot('name', $name)
            @if(isset($value))
                @slot('value', $value)
            @endif
        @endcomponent
    </div>
    <div class="col-5 p-0 input-group-text justify-content-center">
        {{ $slot }}
    </div>
</div>