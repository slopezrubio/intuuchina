<div class="misc {{ isset($variant) ? 'misc--' . $variant : '' }}">
    <section class="misc__copyright">
        <p>{!! __('misc.signature', ['year' => \Carbon\Carbon::now()->year]) !!}</p>
    </section>
    <section class="misc__author">
        <span>{{ __('misc.made with love by ') }}</span>
        <a href="http://factoriaf5.org"><img src="{{ asset('storage/images/logo_factoriaf5.png') }}" alt="Logo de factoriaF5"></a>
    </section>
    <section class="misc__legal">
        <p>
            {!! trans('links.terms and conditions') !!}
        </p>
    </section>
</div>
