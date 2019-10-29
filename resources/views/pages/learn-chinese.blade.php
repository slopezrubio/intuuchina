@extends('layouts.master')

@section('content')
    <header id="learn-chinese">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Elemento SLIDER--}}
        @include('partials._header')
    </header>

    <main>
        {{--Incluye los tipos de cursos ofrecidos--}}
        @include('partials._chinese-courses')
    </main>
    @include('partials._footer')
@endsection