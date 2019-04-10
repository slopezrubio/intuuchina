@extends('layouts.master')


@section('content')

<header>
    {{--Elemento NAV--}}
    @include('partials._nav')

    {{--Elemento SLIDER--}}
    @include('partials._slider')
</header>
    {{--Elemento Medios de TV--}}
    @include('partials._news')

    {{--Elemento de los testiomonios que han sido asesorados por Intuuchina--}}
    @include('partials._testimonials')

    {{--Elemento FOOTER--}}
    @include('partials._footer')
@endsection
