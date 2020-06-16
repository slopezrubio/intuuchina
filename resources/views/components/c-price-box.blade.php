<div class="c-price-box" style="background:url({{ asset('storage/images/content/c-price-box_background.jpg') }})">
    <div class="c-price-box__box">
        <div class="c-price-box__box-label">
            <p>{{ $price_box['label'] }}</p>
        </div>
        <div class="c-price-box__box-table">
            @foreach($price_box['currencies'] as $key => $format)
                <span class="c-price-box__price-tag">{{ number_format(round($price*Swap::latest('EUR/'.strtoupper($key))->getValue()), 2) }}<span class="c-price-box__price-format">{{ $format }}</span></span>
            @endforeach
        </div>
        <div class="c-price-box__box-footer">
            @if(isset($footer))
                {!! $footer !!}
            @endif

            @if(isset($price_box['footer']) && !isset($footer))
                {!! $price_box['footer'] !!}
            @endif
        </div>
    </div>
</div>