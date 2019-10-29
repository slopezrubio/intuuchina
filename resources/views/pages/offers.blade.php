@extends('layouts.master')

@section('content')
    <header id="internship">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Título de la página--}}
        @include('partials._header')
    </header>

    <main>
        <div class="row align-items-center items_management container-fluid">
            {{-- Filtro de ofertas --}}
            @include('partials._filter-by')
        </div>

        {{-- Tabla de ofertas --}}
        @include('partials._offers-list')

    </main>

    @include('partials._footer')

@endsection