<label for="{{ isset($bag) ? $bag . '-' . $name : $name }}" class="col-form-label text-md-{{ isset($align) ? $align : 'left' }}">
    {{ $slot }}
</label>