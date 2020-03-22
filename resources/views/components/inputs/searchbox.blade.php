<form action="{{ $action }}" method="get">
    <div class="searchbox{{ isset($variant) ? ' searchbox--' . $variant : '' }}">
        <button type="submit">
            <i class="fas fa-search"></i>
            <span>{{ __('Search') }}</span>
        </button>
        <input id="{{ $name }}Filter" type="text" class="c-text-input" name="search" {!! isset($placeholder) ? "placeholder='$placeholder'" : '' !!}>
    </div>
</form>