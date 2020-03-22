<footer>
    @include('partials._terms-and-conditions')

    @component('components.modal')
        @include('partials._terms-and-conditions')
    @endcomponent

    @component('components.modal')
        @include('partials._gdpr')
    @endcomponent

{{--    @include('partials._privacy-policy')--}}

    <div class="footer footer--primary col-12">
            {{--Web Map--}}
            <section>
                <h3 class="footer__title">{{ __('content.website map') }}</h3>
                @component('components.web-map')
                    @slot('name', 'footer')
                @endcomponent
            </section>

            {{--Contact form--}}
            <section>
                <h3 class="footer__title">{{ __('content.contact us') }}</h3>

                @include('partials.forms._contact-us')
            </section>

            {{--Social Media Links--}}
            <section>
                @component('components.social-media')
                @endcomponent
            </section>

            <section>
                @component('components.misc')
                    @slot('variant', 'footer')
                @endcomponent
            </section>
        </div>
</footer>