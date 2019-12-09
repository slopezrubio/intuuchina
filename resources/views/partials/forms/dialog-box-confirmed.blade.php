<div id="dialog-box">
    <div class="card-header">
        <h1>{{ __('dialog-box.thanks you for applying') }}</h1>
    </div>

    <div class="card-body">
        <div class="notification-message">
            {!! __('dialog-box.we get 500 people') !!}
        </div>
        <div class="user-card__action">
            <div class="row align-items-center">
                <div class="breadcumb-link col-4">
                    <a href="/">{{ __('links.home') }}</a>
                </div>
                <button type="button" id="continue" class="cta col-6 col-lg-5 col-xl-4 loading-button">
                    <span>{{ __('content.continue') }}</span>
                    <div class="spinner-border hidden" id="spinner"></div>
                </button>
            </div>
        </div>
    </div>
</div>
