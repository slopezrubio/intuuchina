@extends('layouts.master')

@section('title')
    {{ __('meta.title.passwords.' . $view_name) }}
@endsection

@section('content')
    @component('components.header', ['header' => __('component.header.password.email')])
        @slot('variant', 'tertiary')
    @endcomponent

    <main id="reset-password">
        <section id="content" class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8">
                    @include('partials.forms._reset-password')
                </div>
            </div>
        </section>
    </main>

@endsection
