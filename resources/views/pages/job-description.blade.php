@extends('layouts.master')

@section('content')
    <header class="header" id="job-description" data-content="{{ $offer->picture }}">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Título de la página--}}
        @include('partials._header')
    </header>

    <main id="offer">
        <section id="content">

            {{-- Breadcrumb --}}
            @component('components.breadcrumb')
            @endcomponent

            <div class="row">
                <div class="container single-item">
                    <div class="row justify-content-center">
                        <div class="col-10 col-xl-7 mb-4">
                            {{-- Job Description --}}
                            @include('partials._single-offer')
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimonials">
            {{-- Testimonials --}}
            @include('partials._testimonials')
        </section>
    </main>


    {{--Elemento FOOTER--}}
    @include('partials._footer')
@endsection