@extends('layouts.master')

<header class="header" id="about-us">
    {{--Elemento NAV--}}
    @include('partials._nav')

    {{--Elemento SLIDER--}}
    @include('partials._header')
</header>

{{--Elemento de los testiomonios que han sido asesorados por Intuuchina--}}
@include('partials._testimonials')

{{--Elemento FOOTER--}}
@include('partials._footer')