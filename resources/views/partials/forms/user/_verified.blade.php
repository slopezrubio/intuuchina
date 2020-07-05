<form class="extended-form" action="{{ route('payments.' . Auth::user()->program->value) }}" method="POST" id="proceed-payment">
    @csrf
    {!! __('content.verified user', ['program' => Auth::user()->program->name]) !!}

    <ul>
        @foreach(App\FeeType::find(Auth::user()->program->fee_type_id)->fees as $fee)
            <li class="row d-flex align-items-center mb-4">
                <div class="col-12 col-sm-3">
                    {{ $fee->name }}
                </div>
                <div class="col-12 col-sm-9">
                    <span class="price-tag price-tag--secondary">
                        @if($fee->unit !== null)
                            {!!
                                $fee->unit !== 'lesson'
                                ? __('content.per unit', ['price' =>  Money::currencyFormat($fee->amount), 'unit' => $fee->unit])
                                : __('content.per unit', ['price' =>  Money::currencyFormat($fee->amount), 'unit' => '1 hour lesson'])
                            !!}
                        @else
                            <b>{!! Money::currencyFormat($fee->amount) !!}</b>
                        @endif
                    </span>
                </div>
            </li>
        @endforeach
    </ul>

    <div class="col-12 col-sm-6 offset-sm-3">
        @component('components.inputs.shutter-button')
            @slot('content', __('Pay Now'))
            @slot('variant', 'primary')
        @endcomponent
    </div>

</form>

