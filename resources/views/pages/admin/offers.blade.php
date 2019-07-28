@extends('layouts.master')

@section('content')
    <header id="internship">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Título de la página--}}
        @include('partials._page-title')
    </header>

    <main>
        <div class="row">
            {{-- Filtro de ofertas --}}
            @include('partials._filter-by')

            <div class="form-group col-5 form_header">
                <a href="#" class="dropdown-button">Crear Nueva</a>
            </div>
        </div>

        {{-- Tabla de ofertas --}}
        @include('partials._offers-list')

        {{-- Formulario de nueva oferta --}}
        @include('partials._new-offer')
    </main>

    @include('partials._footer')

@endsection