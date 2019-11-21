<div id="dialog">
{{--    <div class="card-header">--}}
{{--        {{ __('content.welcome user page title') }}--}}
{{--    </div>--}}

{{--    <div class="card-body">--}}
{{--        <div class="notification-message">--}}
{{--            {!! __('content.we get 500 people') !!}--}}
{{--            <div class="user-card__action">--}}
{{--                <div class="row align-items-center">--}}
{{--                    <div class="breadcumb-link col-4">--}}
{{--                        <a href="/">{{ __('links.home') }}</a>--}}
{{--                    </div>--}}
{{--                    <button type="button" class="cta col-6 col-lg-5 col-xl-4">{{ __('content.continue') }}</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="card-header">
        {{ __('content.payment details') }}
    </div>

    <div class="card-body">
        <form action="#" id="checkout">
            @csrf
            <div class="container">
                <div class="form-group row">
                    <label for="cardholder">{{ __('content.cardholder name') }}</label>
                    <input type="text" id="card-holder-name">
                </div>
                <div class="form-group row">
                    <label for="email-payer">{{ __('content.mail') }}</label>
                    <input type="text" id="email-payer" value="{{ Auth::user()->email }}">
                </div>
                <div class="form-group row">
                    <label for="card-number">{{ __('content.card number') }}</label>
                    <div class="col-12 col-lg-9" id="card-number">
                        <!-- Stripe Card Number element -->
                    </div>
                    <div id="card-errors"></div>
                </div>
                <div class="form-group row">
                    <div class="row col-5">
                        <label for="card-cvc col-12 col-md-5">{{ __('content.cvc') }}</label>
                        <div class="col-12 col-md-5" id="card-cvc">
                            <!-- Stripe Card CVC element -->
                        </div>
                    </div>
                    <div class="row col-5 offset-2">
                        <label for="card-expiry col-12 col-md-5">{{ __('content.card expiry') }}</label>
                        <div class="col-12 col-md-5" id="card-expiry">
                            <!-- Stripe Card Expiry element -->
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div id="submit-errors">
                </div>
                    </div>
                <div class="form-group row">
                    <div id="payment-request-button" class="col-12">

                    </div>
                    <div class="col-8 col-lg-6 offset-2 offset-lg-3" style="display: none">
                        <button class="cta col-12" type="submit" id="checkout-button">{{ __('content.process fee payment') }}</button>
                    </div>
                </div>
            </div>
            {{ env('STRIPE_KEY') }}
        </form>
    </div>
    <script>
        var stripe = Stripe('{{ config("services.stripe.key") }}');
    </script>
</div>