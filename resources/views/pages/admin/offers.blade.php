@extends('layouts.master');

@section('content')
    <header class="auth">
        {{--Elemento NAV--}}
        @include('partials._nav')
    </header>

    {{-- Título de página --}}

    {{-- Tabla de ofertas --}}
        @include('partials._offers-list')

@endsection