@extends('layouts.master')

@section('content')

    @component('components.header', ['href' => route('internship')])
        @slot('variant')
            {{ 'primary' }}
        @endslot

        @slot('background_image')
            {{ $offer->picture }}
        @endslot

        @slot('title')
            {!!  __('content.industries' .$offer->industry) !!}
        @endslot

        @slot('subtitle')
            {{ $offer->title }}
        @endslot
    @endcomponent

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