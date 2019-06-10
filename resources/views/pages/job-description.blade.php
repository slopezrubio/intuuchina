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
@endsection