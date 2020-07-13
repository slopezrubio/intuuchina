@extends('layouts.master')

@section('title')
    {{ __('meta.title.' . $view_name, ['job' => $offer->title]) }}
@endsection

@section('description')
    <meta name="description" content="{{ $offer->title . ' • ' . Illuminate\Support\Str::words(json_decode($offer->description)->ops[0]->insert) }}">
@endsection

@section('content')

    @component('components.header')
        @slot('variant', 'primary')
        @slot('header', [
            'title' => $offer->category->name,
            'background' => asset('storage/images/' . $offer->picture),
            'subtitle' => $offer->title,
        ])
    @endcomponent


    <main id="job-description">

        <section id="toolbar">
            @component('components.breadcrumb')
                @slot('links', 'component.breadcrumbs.'.$view_name)
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