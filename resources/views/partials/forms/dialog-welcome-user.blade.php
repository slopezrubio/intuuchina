<div id="dialog-box">
    <div class="card-header">
        <h1>{{ __('dialog-box.thanks you for applying') }}</h1>
    </div>

    <div class="card-body">
        <form id="confirm" action="{{ route('confirm') }}" method="post">
            @csrf
            {!! __('dialog-box.one of our colleagues') !!}
            <div class="user-card__action">
                <button type="submit" class="cta col-6 col-lg-5 mt-5 col-xl-4">{{ __('content.confirm') }}</button>
            </div>
        </form>
    </div>
</div>