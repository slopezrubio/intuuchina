<div id="dialog-box">
    <div class="card-header">
        {{ __('content.welcome user page title') }}
    </div>

    <div class="card-body">
        <form id="confirm" action="{{ route('confirm') }}" method="post">
            @csrf
            {!! __('content.welcome user text') !!}
            <div class="user-card__action">
                <button type="submit" class="cta col-6 col-lg-5 mt-5 col-xl-4">{{ __('content.confirm') }}</button>
            </div>
        </form>
    </div>
</div>