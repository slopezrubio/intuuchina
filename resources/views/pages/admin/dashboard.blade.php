@extends('layouts.master')

@section('content')
    <header id="dashboard">

        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Título de la página--}}
        @include('partials.admin._header')
    </header>
    <main>
        @include('partials.admin._dashboard-options')
    </main>

    {{--Elemento FOOTER--}}
    @include('partials._footer')