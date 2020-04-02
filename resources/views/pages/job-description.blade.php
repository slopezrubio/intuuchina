@extends('layouts.master')

@section('content')

    @component('components.header')
        @slot('variant', 'primary')
        @slot('header', [
            'title' => __('content.industries.' .$offer->industry),
            'background' => asset('storage/images/' . $offer->picture),
            'subtitle' => $offer->title,
        ])
    @endcomponent


    <main id="job-description">

        <section id="toolbar">
            @component('components.breadcrumb')
            @endcomponent
        </section>

        <section id="content" class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-10">
                    {{-- Job Description --}}
                    @include('partials._single-offer')
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        @include('partials._testimonials')
    </main>


    {{--Elemento FOOTER--}}
    @include('partials._footer')
@endsection