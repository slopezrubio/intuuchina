<div id="dialog-box">
    <div class="card-header">
        <h1>{{ __('dialog.thanks you for applying') }}</h1>
    </div>

    <div class="card-body">
        <div class="notification-message">
            {!! $slot !!}
        </div>
        <div class="user-card__action">
            <div class="row align-items-center {{ count($actions) > 1 ? 'flex-column' : 'flex-row' }} flex-md-row">
                @if (isset($breadcrumbLink))
                    <div class="breadcrumb-link {{ count($actions) > 1 ? 'col-12 mb-3' : 'col-3' }} mb-md-0 col-md-3">
                        <a href="{{ $breadcrumbLink }}">{{ __('content.' . $breadcrumb) }}</a>
                    </div>
                @endif

                @if (isset($breadcrumbForm))
                    <form class="breadcrumb-link {{ count($actions) > 1 ? 'col-12 mb-3' : 'col-3' }} mb-md-0 col-md-3" action="{{ route(gettext($breadcrumbForm)) }}" id="{{ $breadcrumbForm }}" method="POST">
                        <button type="submit" name="submit">{{ __('content.' . $breadcrumb) }}</button>
                    </form>
                @endif

                @if (isset($actions))
                    <form action="{{ route(gettext($cardActionForm)) }}" id="{{ isset($payment) ? 'payment' : $cardActionForm }}" method="POST" class="{{ count($actions) > 1 ? 'col-12' : 'col-9' }} col-md-9 d-flex justify-content-around justify-content-md-end">
                        @csrf
                        @foreach($actions as $action)
                            <button type="submit" id="{{ $action }}" class="cta col-5 col-lg-5 col-xl-5 loading-button">
                                <span>{{ __('content.' . $action) }}</span>
                                <span style="display: none">{{ __('content.loading...') }}<i class="spinner-border hidden" id="spinner"></i></span>
                            </button>
                        @endforeach
                    </form>
                @endif
            </div>
        </div>
    </div>
    <div class="card-footer">
        {!! $cardFooter !!}
    </div>
</div>
