<button {!! isset($name) ? "name='" . $name . "'" : '' !!}
        type="button" class="c-cta-button {{ isset($variant) ? 'c-cta-button--' . $variant : '' }}"
        data-dismiss="modal" aria-label="{{ isset($label) ? $label : 'Close' }}" {!! isset($id) ? "id='" . $id . "'" : '' !!}>
        <span {!! isset($data) ? "data-value='" . $data . "'" : '' !!} >{{ isset($content) ? $content : '' }}</span>
</button>