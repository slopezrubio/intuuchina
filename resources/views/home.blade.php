@extends('layouts.master')

@section('content')
    <header id="welcome" class="header">

        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Carta de bienvenida del usuario--}}
        @include('partials._welcome-card')

    </header>
@endsection
