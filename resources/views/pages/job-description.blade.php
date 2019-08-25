@extends('layouts.master')

@section('content')
    <header id="job-description" data-content="/../../{{ $offer->picture }}">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Título de la página--}}
        @include('partials._page-title')
    </header>

    {{-- Ficha de la oferta de empleo --}}
    @include('partials._single-offer')

    {{--Elemento de los testiomonios que han sido asesorados por Intuuchina--}}
    @include('partials._testimonials')

    {{--Elemento FOOTER--}}
    @include('partials._footer')
@endsection