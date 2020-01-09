@extends('layouts.master')

@section('content')
    <header class="header" id="internship">
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

        <section id="content">
            {{-- Tabla de ofertas --}}
            @include('partials._offers-list')
        </section>

    </main>

    @include('partials._footer')

@endsection