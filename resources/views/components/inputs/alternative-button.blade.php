<button {!! isset($name) ? "name='" . $name . "'" : '' !!} type="{{ isset($href) ? 'button' : 'submit' }}" class="c-alternative-button{{ isset($variant) ? ' c-alternative-button--' . $variant : '' }}">
    @if(isset($href))
        <a href="{{ $href }}">
            {{ $content }}
            @if(isset($fas) || isset($fab))
                <i class="{{ isset($fab) ? 'fab' : 'fas' }} fa-{{ isset($fab) ? $fab : $fas }}"></i>
            @endif
        </a>
    @else
        {{ $content }}
    @endif
</button>