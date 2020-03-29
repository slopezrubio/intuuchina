<div class="card-image">
    <div class="card-image__background" style="background-image: {{ isset($background) ? 'url(' . $background . ')' : 'none'}}">
        <div class="card-image__shower-screen">
            <h5 class="card-image__title">{{ strtoupper($title) }}</h5>
            <p class="card-image__text">
                {{ $content['text'] }}
                <span class="card-image__unit"><strong>{{ $content['value'] }}</strong></span>
                <span>{{ $content['unit'] }}</span>
            </p>
        </div>
    </div>
</div>