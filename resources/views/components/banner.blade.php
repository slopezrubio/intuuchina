<div class="banner {{ isset($variant) ? 'banner--' . $variant : ''}}">
    <div class="banner__container">
        <div class="banner__thumbnail col-12 p-0">
            @switch($variant)
                @case('success')
                    <i class="fas fa-check-circle"></i>
                    @break
            @endswitch
        </div>

        <div class="banner__supporting-text col-12 p-0">
            {!! $text !!}
        </div>

        @if(isset($action))
            <div class="banner__action d-flex flex-column flex-md-row align-items-md-center">
                {!! $action !!}
            </div>
        @endif
    </div>
</div>