<form method="POST" action="{{ route('payment_method') }}"  id="payment">
    <script>
        var stripe = Stripe('{{ config("services.stripe.key") }}');
        var currencies = @json(__('currencies'));
    </script>
    @csrf

    <div class="form__container container-fluid p-0">

        <div class="form-group align-items-end row">
            <div class="col-12 col-lg-3">
                @component('components.inputs.label', ['name' => 'card_holder'])
                    {{ __('Cardholder Name') }}
                @endcomponent
            </div>
            <div class="col-12 col-lg-9">
                @component('components.inputs.text')
                    @slot('name', 'card_holder')
                    @slot('placeholder', __('Card Holder Name'))
                @endcomponent
            </div>
            <div class="offset-lg-3 col-12 invalid-feedback" role="alert" id="card_holder_name-errors">
                <!-- Stripe Card Holder name errors -->
            </div>
        </div>

        <div class="form-group align-items-end row">
            <div class="col-12 col-lg-3">
                @component('components.inputs.label', ['name' => 'phone_number'])
                    {{ __('Phone Number') }}
                @endcomponent
            </div>
            <div class="col-12 col-lg-9 d-flex p-0">
                @component('components.inputs.phone')
                    @slot('name', 'phone_number')
                    @slot('value', Auth::user()->phone_number['number'])
                @endcomponent
            </div>
            <div class="offset-lg-3 invalid-feedback col-12" role="alert" id="phone_number-errors">
                <!-- Stripe Phone Number errors -->
            </div>
        </div>

        <div class="form-group align-items-end row">
            <div class="col-12 col-lg-3">
                @component('components.inputs.label', ['name' => 'email', 'bag' => 'payment'])
                    {{ __('E-Mail Address') }}
                @endcomponent
            </div>
            <div class="col-12 col-lg-9">
                @component('components.inputs.text')
                    @slot('name', 'email')
                    @slot('bag', 'payment')
                    @slot('value', Auth::user()->email)
                    @slot('placeholder', __('placeholder.email.default'))
                @endcomponent
            </div>
            <div class="offset-lg-3 col-12 invalid-feedback" role="alert" id="email-errors">
                <!-- Stripe Email errors -->
            </div>
        </div>

        <div class="form-group align-items-end row">
            <div class="col-12 col-lg-3">
                @component('components.inputs.label', ['name' => 'study'])
                    {{ __('Chinese Studies') }}
                @endcomponent
            </div>
            <div class="col-12 col-lg-9">
                @component('components.inputs.select', ['options' =>  array_column(__('content.courses'), 'text', key(current(__('content.courses'))))])
                    @slot('name', 'study')
                    @slot('value', Auth::user()->study[0])
                @endcomponent
            </div>
        </div>

        <div class="form-group align-items-end row {{ Auth::user()->study[0] !== 'online' ? 'hidden' : '' }}">
            <div class="col-12 col-lg-3">
                @component('components.inputs.label', ['name' => 'hours'])
                    {{ __('Duration') }}
                @endcomponent
            </div>
            <div class="col-12 col-lg-9 input-group">
                @component('components.inputs.prepended-text')
                    @slot('name', 'hours')
                    @slot('value', __('content.courses.online.scope.min'))
                    {{ __('Hours') }}
                @endcomponent
            </div>
            <div class="offset-lg-3 col-12 invalid-feedback" role="alert" id="hours-errors">
                <!-- Stripe Hours errors -->
            </div>
        </div>

        <div class="form-group align-items-end row {{ Auth::user()->study[0] !== 'in-person' && Auth::user()->study[0] !== null ? 'hidden' : '' }}">
            <div class="col-12 col-lg-3">
                @component('components.inputs.label', ['name' => 'staying'])
                    {{ __('Duration') }}
                @endcomponent
            </div>
            <div class="col-12 col-lg-9 input-group">
                @component('components.inputs.prepended-text')
                    @slot('name', 'staying')
                    @slot('value', __('content.courses.in-person.scope.min'))
                    {{ __('Months') }}
                @endcomponent
            </div>

            <div class="offset-lg-3 col-12 invalid-feedback" role="alert" id="staying-errors">
                <!-- Stripe Staying errors -->
            </div>
        </div>

        <div class="form-group align-items-center row">
            <div class="col-12 col-lg-3">
                @component('components.inputs.label', ['name' => 'card-number'])
                    {{ __('Card Number') }}
                @endcomponent
            </div>
            <div class="col-12 col-lg-9" id="card-number">
                <!-- Stripe Card Number element -->
            </div>
            <div class="col-12 col-lg-9 offset-lg-3 invalid-feedback" id="card-number-errors">
                <!-- Stripe Card Number errors -->
            </div>
        </div>

        <div class="form-group justify-content-between row">
            <div class="row align-items-center align-content-start col-6 col-lg-4 col-md-6 p-lg-0 offset-lg-3">
                <div class="col-12 col-lg-3">
                    @component('components.inputs.label', ['name' => 'card-cvc'])
                        {{ __('CVC') }}
                    @endcomponent
                </div>
                <div class="col-7 col-lg-5 col-md-5" id="card-cvc">
                    <!-- Stripe Card CVC element -->
                </div>
                <div class="offset-lg-3 col-md-12 col-lg-9 col-12 invalid-feedback" id="card-cvc-errors">
                    @if ($errors->has('cvc'))
                        {{ $errors->first('cvc') }}
                    @endif
                </div>
            </div>
            <div class="row align-items-center col-6 col-lg-5 col-md-6">
                <div class="col-12 col-lg-6 ml-auto">
                    @component('components.inputs.label', ['name' => 'card-expiry'])
                        {{ __('Card Expiry') }}
                    @endcomponent
                </div>
                <div class="col-12 col-lg-6" id="card-expiry">
                    <!-- Stripe Card Expiry element -->
                </div>
                <div class="offset-lg-6 col-lg-5 col-12 invalid-feedback" id="card-expiry-errors">
                    <!-- Stripe Card Expiry errors -->
                    @if ($errors->has('exp_month'))
                        {{ $errors->first('exp_month') }}
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group align-items-end row">
            <div class="col-12 col-lg-3">
                @component('components.inputs.label', ['name' => 'payment-currency'])
                    {{ __('Currency') }}
                @endcomponent
            </div>
            <div class="col-12 col-lg-9">
                @component('components.inputs.select', ['options' => array_column(__('currencies'), 'text', key(current(__('currencies'))))])
                    @slot('name', 'payment-currency')
                @endcomponent
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
                <div class="col-12" >
                    @component('components.inputs.cta-button', ['data' => $intent->amount])
                        @slot('variant', 'primary mr-auto')
                        @slot('name', 'pay')
                        @slot('id', 'checkout-button-sku_GDHDkOPWtjGF2w')
                        @slot('content', __('content.pay', ['value' => numfmt_format_currency(numfmt_create(Config::get('app.locale'), \NumberFormatter::CURRENCY), number_format(intval($intent->amount) / 100, 2), Config::get('services.stripe.cashier_currency'))]))
                    @endcomponent
{{--                    <button class="cta col-12 loading-button" type="submit" data-stripe="{{ $intent->client_secret }}" id="checkout-button-sku_GDHDkOPWtjGF2w">--}}
{{--                        <span data-value="{{ $intent->amount }}">{{ __('content.pay', ['value' => numfmt_format_currency(numfmt_create(Config::get('app.locale'), \NumberFormatter::CURRENCY), number_format(intval($intent->amount) / 100, 2), Config::get('services.stripe.cashier_currency'))]) }}</span>--}}
{{--                        <span style="display: none">{{ __('content.loading...') }}<i class="spinner-border hidden" id="spinner"></i></span>--}}
{{--                    </button>--}}
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <form action="{{ route('home') }}" method="GET">
                    @component('components.inputs.alternative-button')
                        @slot('content', __('Cancel'))
                    @endcomponent
                </form>
            </div>
        </div>
    </div>
</form>