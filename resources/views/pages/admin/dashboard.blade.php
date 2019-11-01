@extends('layouts.master')

@section('content')
    <header class="header header--no-background-image" id="dashboard">

        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Título de la página--}}
        @include('partials._header')
    </header>
    <main>
        @include('partials.admin._dashboard-options')
    </main>

    {{--Elemento FOOTER--}}
    @include('partials._footer')