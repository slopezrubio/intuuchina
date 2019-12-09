<div id="dialog-box">
    <div class="card-header">
        <h1>{{ __('dialog-box.payment details') }}</h1>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('payment_method') }}"  id="checkout">
            @csrf
            <script>
                var stripe = Stripe('{{ config("services.stripe.key") }}');
                var currencies = @json($currencies);
            </script>

            <div class="container">

                <div class="form-group align-items-end row">
                    <label class="col-12 col-lg-3 p-0" for="cardholder">{{ __('content.cardholder name') }}</label>
                    <input class="col-12 col-lg-9 {{ $errors->has('card_holder_name') ? ' is-invalid' : '' }}" name="card_holder_name" type="text" id="card_holder_name">
                    <div class="offset-lg-3 col-12 invalid-feedback" role="alert" id="card_holder_name-errors">
                        <!-- Stripe Card Holder name errors -->
                    </div>
                </div>

                <div class="form-group align-items-end row">
                    <label for="phone_number" class="col-12 col-lg-3 p-0">{{ __('content.phone number') }}</label>
                    <input type="tel" id="phone_number" class="col-12 col-lg-3 p-0 {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" name="phone_number" value="{{ json_decode(Auth::user()->phone_number)->number }}">
                    <div class="offset-lg-3 invalid-feedback col-12" role="alert" id="phone_number-errors">
                        <!-- Stripe Phone Number errors -->
                    </div>
                </div>

                <div class="form-group align-items-end row">
                    <label class="col-12 col-lg-3 p-0" for="email">{{ __('content.mail') }}</label>
                    <input class="col-12 col-lg-9 {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="text" id="email" value="{{ Auth::user()->email }}">
                    <div class="offset-lg-3 col-12 invalid-feedback" role="alert" id="email-errors">
                        <!-- Stripe Email errors -->
                    </div>
                </div>

                <div class="form-group align-items-center row">
                    <label class="col-12 col-lg-3 p-0" for="card-number">{{ __('content.card number') }}</label>
                    <div class="col-12 col-lg-9" id="card-number">
                        <!-- Stripe Card Number element -->
                    </div>
                    <div class="offset-lg-3 invalid-stripe-feedback" id="card-number-errors">
                        <!-- Stripe Card Number errors -->
                    </div>
                </div>

                <div class="form-group justify-content-between row">
                    <div class="row align-items-center align-content-start col-6 col-lg-4 col-md-6 p-lg-0 offset-lg-3">
                        <label for="card-cvc" class="col-12 col-lg-3 p-0">{{ __('content.cvc') }}</label>
                        <div class="col-7 col-lg-5 col-md-5" id="card-cvc">
                            <!-- Stripe Card CVC element -->
                        </div>
                        <div class="offset-lg-3 col-md-12 col-lg-9 col-12 p-0 invalid-stripe-feedback" id="cvc-errors">
                            @if ($errors->has('cvc'))
                                {{ $errors->first('cvc') }}
                            @endif
                        </div>
                    </div>
                    <div class="row align-items-center col-6 col-lg-5 col-md-6">
                        <label class="col-12 col-lg-6 ml-auto p-0" for="card-expiry">{{ __('content.card expiry') }}</label>
                        <div class="col-12 col-lg-6" id="card-expiry">
                            <!-- Stripe Card Expiry element -->
                        </div>
                        <div class="offset-lg-6 col-lg-5 col-12 p-0 invalid-stripe-feedback" id="card-expiry-errors">
                            <!-- Stripe Card Expiry errors -->
                            @if ($errors->has('exp_month'))
                                {{ $errors->first('exp_month') }}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group align-items-end row">
                    <label class="col-12 col-lg-3 p-0" for="payment-currency">{{ __('content.currency') }}</label>
                    <div class="col-12 col-lg-9 p-0">
                        <div class="regular--select-wrapper">
                            <select name="payment-currency" id="payment-currency" class="form-control">
                                @foreach (__('currencies') as $key => $option)
                                    <option value="{{ $key }}">{{ $option['text'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="payment-method" id="payment-method">

                <div class="row">
                    <div class="col-12 col-lg-9 offset-lg-3 invalid-stripe-feedback" id="submit-errors">
                        <!-- Stripe Submit errors -->
                         @if ($errors->has('submit'))
                             {{ $errors->first('submit')}}
                         @endif
                    </div>
                </div>
                <div class="user-card__action">
                    <div class="form-group row">
                        <div id="payment-request-button" class="col-12">
                            <!-- Stripe Payment Request Button -->
                        </div>
                        <div class="col-12 p-0 col-md-8 col-lg-6 offset-md-2 offset-lg-3" style="display: none">
                            <button class="cta col-12 loading-button" type="submit" data-stripe="{{ $intent->client_secret }}" id="checkout-button-sku_GDHDkOPWtjGF2w">
                                <span data-value="{{ $intent->amount }}">{{ __('content.pay', ['value' => numfmt_format_currency(numfmt_create(Config::get('app.locale'), \NumberFormatter::CURRENCY), number_format($intent->amount / 100, 2), Config::get('services.stripe.cashier_currency'))]) }}</span>
                                <div class="spinner-border hidden" id="spinner"></div>
                            </button>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div>
                            <a href="{{ route('home') }}">
                                {{ __('content.cancel') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>