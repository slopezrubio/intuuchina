@extends('layouts.master')

@section('content')
    <header>
            {{--Elemento NAV--}}
            @include('partials._nav')

            {{--Elemento SLIDER--}}
            @include('partials._header')
    </header>

    {{-- Elemento donde se recogen las ofertas de trabajo --}}
    @include('partials._offers')
@endsection