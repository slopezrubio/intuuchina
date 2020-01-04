@extends('layouts.master')

@section('content')
    <header class="header" id="university">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Elemento SLIDER--}}
        @include('partials._header')
    </header>

    <main>
        {{--Incluye los tipos de master ofrecidos--}}
        @include('partials._university-slider')
    </main>
    @include('partials._footer')
@endsection