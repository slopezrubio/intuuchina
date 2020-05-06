@extends('layouts.master')

@section('content')

    @component('components.header')
        @slot('variant', 'secondary h-100')

        @slot('header', [
            'background' => __('component.header.user.welcome.background'),
        ])

        @slot('dialog', 'partials.dialogs.user._verified')
    @endcomponent

{{--    <header id="welcome" class="header">--}}
{{--        --}}
{{--        @include('partials._nav')--}}

{{--        @if(Auth::user()->type === 'user')--}}
{{--            <div class="container user-card">--}}
{{--                <div class="row justify-content-center">--}}
{{--                    <div class="col-md-10">--}}
{{--                        <div class="card">--}}
{{--                            @component('components.forms.dialog-box-verified', ['actions' => ['pay now'], 'breadcrumb' => 'home', 'payment' => $payment])--}}
{{--                                {!! __('dialog.the verification process is done', ['program' => __('content.programs.'. Auth::user()->program)]) !!}--}}

{{--                                @slot('breadcrumbLink')--}}
{{--                                    {{ 'home' }}--}}
{{--                                @endslot--}}

{{--                                @slot('cardActionForm')--}}
{{--                                    {{ 'payments.' . Auth::user()->program }}--}}
{{--                                @endslot--}}

{{--                                @slot('cardFooter')--}}
{{--                                    <ul>--}}
{{--                                        <li>--}}
{{--                                            {!! __('dialog.are you in doubt?') !!}--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                @endslot--}}
{{--                            @endcomponent--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </header>--}}
@endsection
