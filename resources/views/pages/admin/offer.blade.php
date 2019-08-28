@extends('layouts.master')

@section('content')
    <header id="internship">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Título de la página--}}
        @include('partials._page-title')
    </header>

    {{--Formulario de edición de oferta--}}
    @include('partials._edit-offer')

    @include('partials._footer')

@endsection