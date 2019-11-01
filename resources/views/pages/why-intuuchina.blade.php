@extends('layouts.master')

@section('content')
    <header class="header" id="why-us">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Elemento que muestras las estadísticas de Intuuchina--}}
        @include('partials._stats')
    </header>

    {{--Elemento que muetra información extra sobre los motivos de elegir Intuuchina--}}
    @include('partials._motifs')

    {{--Elemento FOOTER--}}
    @include('partials._footer')
@endsection