<section class="breadcumb_section">
    <ol>
        @auth
            @if(Auth::user()->type !== 'admin')
                <li class="breadcrumb-item"><a href="{{ route('offers') }}">{{ __('links.back to the job offers') }}</a></li>
            @else
                <li class="breadcrumb-item"><a href="{{ route('admin.offers') }}">{{ __('links.job offers dashboard') }}</a></li>
            @endif
        @else
            <li class="breadcrumb-item"><a href="{{ route('offers') }}">{{ __('links.back to the job offers') }}</a></li>
        @endauth
    </ol>
</section>