@extends('layouts.master')

@section('content')
    <header class="header" id="internship">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Título de la página--}}
        @include('partials._header')
    </header>

    {{--Ventana modal para eliminar ofertas --}}
    @include('partials.modal-offer')

    <main>

        <div class="row align-items-center items_management container-fluid">

            {{-- Filtro de ofertas --}}
            @include('partials._filter-by')

            @auth
                @if(Auth::user()->type === 'admin')
                    <div class="crud-buttons offset-2 col-2 col-sm-2 col-lg-5">
                        <a href="#" class="cta col-4 float-right dropdown-button">New</a>
                    </div>
                @endif
            @endauth
        </div>

        {{-- Tabla de ofertas --}}
        @include('partials._offers-list')

        {{-- Formulario de nueva oferta --}}
        @include('partials._new-offer')
    </main>

    @include('partials._footer')

@endsection