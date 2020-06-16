@extends('layouts.master')

@section('content')

    @component('components.header', ['header' => __('component.header.password.change')])
        @slot('variant', 'tertiary')
    @endcomponent

    <main id="reset-password">
        <section id="content" class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8">

                    @if(Auth::user()->type === 'admin')
                        @include('partials.forms.admin._change-password')
                    @elseif(Auth::user()->type === 'user')
                        @include('partials.forms.user._change-password')
                    @endif

                </div>
            </div>
        </section>
    </main>

@endsection
