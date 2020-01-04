<div id="dialog-box">
    <div class="card-header">
        <h1>{{ __('dialog-box.confirmation receipt') }}</h1>
    </div>

    <div class="card-body">
        <div class="notification-message">
            {!! __('dialog-box.the payment process has been carried out') !!}
            <a target="_blank" href="{{ $receipt_url }}" class="downloadable">
                <i class="fas fa-file-invoice"></i>
                <span>{{ __('content.see your receipt') }}</span>
            </a>
        </div>
        <div class="user-card__action">
            <div class="row align-items-center">
                <button type="button" id="continue" class="cta m-auto col-8 col-md-6 col-xl-4 loading-button">
                    <span>{{ __('content.ok, i got it!') }}</span>
                    <div class="spinner-border hidden" id="spinner"></div>
                </button>
            </div>
        </div>
    </div>
</div>