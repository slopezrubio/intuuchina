<div id="dialog-box">
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
        <form method="POST" action="{{ route('fee_payment', Auth::id()) }}"  id="checkout">
            @csrf
            <div class="container">

                <div class="form-group align-items-end row">
                    <label class="col-12 col-lg-3 p-0" for="cardholder">{{ __('content.cardholder name') }}</label>
                    <input class="col-12 col-lg-9 {{ $errors->has('card-holder-name') ? ' is-invalid' : '' }}" name="card-holder-name" type="text" id="card-holder-name">
                    <div class="offset-lg-3 col-12 invalid-feedback" role="alert" id="card-holder-name-errors"></div>
                </div>

                <div class="form-group align-items-end row">
                    <label for="phone_number" class="col-12 col-lg-3 p-0">{{ __('content.phone number') }}</label>
                    <input type="tel" id="phone_number" class="col-12 col-lg-3 p-0 {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" name="phone_number" value="{{ json_decode(Auth::user()->phone_number)->number }}">
                    <div class="offset-lg-3 invalid-feedback col-12" role="alert" id="phone_number-errors"></div>
                </div>

                <div class="form-group align-items-end row">
                    <label class="col-12 col-lg-3 p-0" for="email-payer">{{ __('content.mail') }}</label>
                    <input class="col-12 col-lg-9 {{ $errors->has('email-payer') ? ' is-invalid' : '' }}" name="email-payer" type="text" id="email-payer" value="{{ Auth::user()->email }}">
                    <div class="offset-lg-3 col-12 invalid-feedback" role="alert" id="email-payer-errors"></div>
                </div>

                <div class="form-group align-items-center row">
                    <label class="col-12 col-lg-3 p-0" for="card-number">{{ __('content.card number') }}</label>
                    <div class="col-12 col-lg-9" id="card-number">
                        <!-- Stripe Card Number element -->
                    </div>
                    <div class="offset-lg-3 invalid-stripe-feedback" id="card-number-errors"></div>
                </div>

                <div class="form-group justify-content-between row">
                    <div class="row align-items-start align-content-start col-6 col-lg-4 col-md-6 p-lg-0 offset-lg-3">
                        <label for="card-cvc" class="col-12 col-lg-3 p-0">{{ __('content.cvc') }}</label>
                        <div class="col-7 col-lg-5 col-md-5" id="card-cvc">
                            <!-- Stripe Card CVC element -->
                        </div>
                        <div class="offset-lg-3 col-md-5 col-12 p-0 invalid-stripe-feedback" id="cvc-errors"></div>
                    </div>
                    <div class="row align-items-center col-6 col-lg-5 col-md-6">
                        <label class="col-12 col-lg-6 ml-auto p-0" for="card-expiry">{{ __('content.card expiry') }}</label>
                        <div class="col-12 col-lg-6" id="card-expiry">
                            <!-- Stripe Card Expiry element -->
                        </div>
                        <div class="offset-lg-6 col-lg-5 col-12 p-0 invalid-stripe-feedback" id="card-expiry-errors"></div>
                    </div>
                </div>

                <div class="form-group align-items-end row">
                    <label class="col-12 col-lg-3 p-0" for="payment-currency">{{ __('content.currency') }}</label>
                    <div class="col-12 col-lg-9 p-0">
                        <div class="regular--select-wrapper">
                            <select name="payment-currency" id="payment-currency" class="form-control">
                                @foreach (__('content.payment currency') as $key => $option)
                                    <option value="{{ $option['value'] }}">{{ $option['text'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="payment-method" id="payment-method">

                <div class="is-invalid" id="submit-errors"></div>
                <div class="form-group row">
                    <div id="payment-request-button" class="col-12">
                        <!-- Stripe Payment Request Button -->
                    </div>
                    <div class="col-12 p-0 col-md-8 col-lg-6 offset-md-2 offset-lg-3" style="display: none">
                        <button class="cta col-12" type="submit" id="checkout-button-sku_GDHDkOPWtjGF2w">{{ __('content.process fee payment') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        var stripe = Stripe('{{ config("services.stripe.key") }}');
    </script>
</div>
