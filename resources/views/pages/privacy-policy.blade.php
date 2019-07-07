@extends('layouts.master')


@section('content')

    <header id="home">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Título de la página--}}
        @include('partials._page-title')
    </header>

    <p>Política de privacidad</p>

    {{--Elemento FOOTER--}}
    @include('partials._footer')
@endsection