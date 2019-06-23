@extends('layouts.master')

@section('content')
    <header id="learn-chinese">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Elemento SLIDER--}}
        @include('partials._page-title')
    </header>

    <main>
        {{--Incluye los tipos de cursos ofrecidos--}}
        @include('partials._chinese-courses')
    </main>
@endsection