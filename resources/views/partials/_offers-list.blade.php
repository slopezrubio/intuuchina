<div class="container-fluid offers">
    <div class="list-group manager-list">
        @foreach($offers as $offer)
            <a href="#" class="list-group-item flex-column align-items-start">
                <div class="d-flex justify-content-between">
                    <h5 class="mb-1">{{ $offer->title }}</h5>
                    <small>{{ $offer->gone_by }}</small>
                </div>
                <small>{{ $offer->industry }}</small>
            </a>
        @endforeach
    </div>
</div>