@extends('layouts.master')

@section('content')
    <header id="welcome" class="header">

        {{--Elemento NAV--}}
        @include('partials._nav')

        @if(Auth::user()->type === 'user')
            <div class="container user-card">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            @if(isset($payment))
                                @component('components.forms.dialog-box-verified', ['actions' => ['agree', 'decline'], 'breadcrumb' => 'home', 'payment' => $payment])
                                    {!! __('dialog.verification process succeed') !!}
                                    {!! __('dialog.do you really want to proceed') !!}

                                    @slot('breadcrumbLink')
                                        {{ 'home' }}
                                    @endslot

                                    @slot('cardActionForm')
                                        {{ 'payments.' . Auth::user()->program }}
                                    @endslot
                                @endcomponent
                            @else
                                @component('components.forms.dialog-box-verified', ['actions' => ['home'], 'breadcrumb' => 'pay now'] )
                                    {!! __('dialog.verification process succeed') !!}
                                    {!! __('dialog.payment reminder', ['program' => __('content.programs.' . Auth::user()->program) ]) !!}

                                    @slot('breadcrumbForm')
                                        {{ 'payments.' . Auth::user()->program }}
                                    @endslot

                                    @slot('cardActionForm')
                                        {{ 'home' }}
                                    @endslot
                                @endcomponent
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </header>
@endsection
