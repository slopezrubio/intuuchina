@extends('layouts.master');

@section('content')
    <header class="auth">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{-- Título de página --}}
        <div class="main-title row">
            <div class="title-card col-8 col-sm-8 col-md-8 col-lg-10 col-xl-10">
                <h1 class="title-card-header">Ofertas</h1>
            </div>
        </div>
    </header>



    {{-- Tabla de ofertas --}}
        @include('partials._offers-list')

@endsection