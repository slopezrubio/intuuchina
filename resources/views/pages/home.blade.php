@extends('layouts.master')


@section('content')

    <header id="home">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Título de la página--}}
        @include('partials._page-title')
    </header>
    <main>
        {{--Elemento Medios de TV--}}
        @include('partials._news')

        {{--Sección de los servicios ofrecidos--}}
        @include('partials._services')

        {{--Elemento de los testiomonios que han sido asesorados por Intuuchina--}}
        @include('partials._testimonials')
    </main>

        {{--Elemento FOOTER--}}
        @include('partials._footer')
@endsection
