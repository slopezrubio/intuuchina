<div id="dialog-box" class="dialog-box">
    <div class="dialog-box__container container">
        <h1 class="dialog-box__title col-12">
            {{ $title }}
        </h1>

        <div class="dialog-box__content">
            @if(isset($dialog))
                <div class="dialog-box__dialog">
                    {!! $dialog !!}
                </div>
            @endif
            <div class="dialog-box__actions">
                @if(isset($actions))
                    {{ $actions }}
                @endif
            </div>

            @if(isset($footer))
                <div class="dialog-box__footer">
                    {!! $footer !!}
                </div>
            @endif
        </div>
    </div>
</div>