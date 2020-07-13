@if(isset($href))
    <div class="c-cta-button {{ isset($variant) ? 'c-cta-button--' . $variant : '' }} {!! isset($id) ? "id='" . $id . "'" : '' !!}">
        <a href="{{ $href }}">
            {{ isset($content) ? $content : '' }}
            @if(isset($fas) || isset($fab))
                <i class="{{ isset($fab) ? 'fab' : 'fas' }} fa-{{ isset($fab) ? $fab : $fas }}"></i>
            @endif
        </a>
    </div>
@else
    <button {!! isset($name) ? "name='" . $name . "'" : '' !!} type="{{ isset($href) ? 'button' : 'submit' }}" {!! isset($value) ? 'value='.$value : '' !!} class="c-cta-button {{ isset($variant) ? 'c-cta-button--' . $variant : '' }}" {!! isset($id) ? "id='" . $id . "'" : '' !!}>
        <span {!! isset($data) ? "data-value='" . $data . "'" : '' !!} >{{ isset($content) ? $content : '' }}</span>
        <span style="display:none">{{ __('Loading...') }}<i class="c-cta-button__loader hidden spinner-border"></i></span>
    </button>
@endif