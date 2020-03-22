<form class="extended-form" action="{{ route('payments.' . Auth::user()->program) }}" method="POST" id="proceed-payment">
    <p>
        {!! __('content.verified user', ['program' => __('content.programs.' . Auth::user()->program)]) !!}
    </p>
    <p>
        {{ __('content.invoice.' . Auth::user()->program . '.description') }}
    </p>

    <ul>
        @if(Auth::user()->program === 'study')
            @foreach(__('content.courses') as $key => $value)
                <li class="row d-flex align-items-center mb-4">
                    <div class="col-12 col-sm-3">
                        {{ $value['text'] }}
                    </div>
                    <div class="col-12 col-sm-9">
                        <span class="price-tag price-tag--secondary">
                            {!! $key == 'online'
                                    ? __('content.per hour', ['price' => Money::currencyFormat($value['price'][config('services.stripe.cashier_currency')])])
                                      : __('content.per month', ['price' => Money::currencyFormat($value['price'][config('services.stripe.cashier_currency')])]) !!}
                        </span>
                    </div>
                </li>
            @endforeach
        @else
            <li class="row d-flex align-items-center mb-4">
                <div class="col-12 col-sm-3">
                    {{ __('Appliction Fee') }}
                </div>
                <div class="col-12 col-sm-9">
                    {{ Money::currencyFormat(__('content.application fee.price.eur')) }}
                </div>
            </li>
        @endif
    </ul>

    @csrf
    <div class="col-12 col-sm-6 offset-sm-3">
        @component('components.inputs.shutter-button')
            @slot('content', __('Pay Now'))
            @slot('variant', 'primary')
        @endcomponent
    </div>

</form>

