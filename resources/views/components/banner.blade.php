<div class="banner {{ isset($variant) ? 'banner--' . $variant : ''}}">
    <div class="banner__container">
        <div class="banner__thumbnail {{ isset($variant) ? 'banner__thumbnail--'.$variant : '' }} col-12 p-0">
            @if(isset($variant))
                @switch($variant)
                    @case('success')
                        <i class="fas fa-check-circle"></i>
                        @break
                    @case('info')
                        <i class="fas fa-info-circle"></i>
                        @break
                @endswitch
            @endif
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