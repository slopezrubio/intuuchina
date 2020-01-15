@extends('layouts.master')

@section('content')
    <header class="header" id="internship">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Título de la página--}}
        @include('partials._header')
    </header>

    <main id="job-board" class="container-fluid">
        <section id="search-tool">
            @component('components.toolbars.job-board')

            @endcomponent
        </section>

        <section id="content">
            {{-- Tabla de ofertas --}}
            @include('partials._offers-list')
        </section>

    </main>

    @include('partials._footer')

@endsection