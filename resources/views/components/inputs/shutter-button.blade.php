@if(isset($variant))

    @if($variant === 'modal')
        <button type="{{ isset($type) ? $type : 'submit' }}" class="modal-button c-shutter-button {{ isset($variant) ? 'c-shutter-button--' . $variant : '' }}" {!! $type === 'reset' ? "data-dismiss='modal'" : '' !!}>
            {{ $content }}
        </button>
    @else
        <button type="{{ isset($type) ? $type : 'submit' }}" class="c-shutter-button {{ isset($variant) ? 'c-shutter-button--' . $variant : '' }}">
            {{ $content }}
        </button>
    @endif

@else
    <button type="{{ isset($type) ? $type : 'submit' }}" class="c-shutter-button">
        {{ $content }}
    </button>
@endif