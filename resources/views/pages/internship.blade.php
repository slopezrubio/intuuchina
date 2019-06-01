@extends('layouts.master')

@section('content')
    <header>
            {{--Elemento NAV--}}
            @include('partials._nav')

            {{--Elemento SLIDER--}}
            @include('partials._page-title')
    </header>

    {{--Elemento donde se recogen las ofertas de trabajo--}}
    @include('partials._offers')
@endsection