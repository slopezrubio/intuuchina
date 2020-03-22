@extends('layouts.master')

@section('content')
    @component('components.header')
        @include('partials.headers._home')
    @endcomponent

    <main id="home">
        {{--Elemento Medios de TV--}}
        @include('partials._press')

        {{--Sección de los servicios ofrecidos--}}
        @include('partials._services')

        {{--Infografia del «Customer Journey»--}}
        @include('partials._customer-journey')

        {{--Elemento de los testiomonios que han sido asesorados por Intuuchina--}}
        @include('partials._testimonials')
    </main>

    {{--Elemento FOOTER--}}
    @include('partials._footer')
@endsection
