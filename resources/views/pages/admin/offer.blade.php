@extends('layouts.master')

@section('content')
    <header id="internship">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Título de la página--}}
        @include('partials._header')
    </header>

    {{--Formulario de edición de oferta--}}
    @include('partials._edit-offer')

    @include('partials._footer')

@endsection