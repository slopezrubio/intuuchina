@extends('layouts.master')

@extends('layouts.master')

<header>
    {{--Elemento NAV--}}
    @include('partials._nav')

    {{--Elemento SLIDER--}}
    @include('partials._slider')
</header>

{{--Apartado de prensa--}}

{{--Características--}}

{{--Elemento de los testiomonios que han sido asesorados por Intuuchina--}}
@include('partials._testimonials')

{{--Elemento FOOTER--}}
@include('partials._footer')