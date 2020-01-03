@extends('layouts.master')

@section('content')
    <header id="welcome" class="header">

        {{--Elemento NAV--}}
        @include('partials._nav')

        @if($verified)
            {{--Carta de bienvenida del usuario--}}
            @include('partials._welcome-card', []);
        @else

        @endif

    </header>
@endsection
