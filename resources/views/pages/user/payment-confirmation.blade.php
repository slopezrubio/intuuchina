@extends('layouts.master')

@section('content')
    @component('components.header')
        @slot('variant', 'tertiary')
        @slot('header', __('component.header.user.payment-confirmation'))
    @endcomponent

    <main id="payment-confirmation">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8">
                    @include('partials.user._payment-completed')
                </div>
            </div>
        </div>
    </main>

    @include('partials._footer')
@endsection