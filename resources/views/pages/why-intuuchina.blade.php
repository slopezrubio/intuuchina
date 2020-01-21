@extends('layouts.master')

@section('content')
    @component('components.stats', ['stats' => __('heading.why-us.stats')])
        @slot('background_image')
            {{ __('heading.why-us.background') }}
        @endslot
    @endcomponent

    {{--Elemento que muetra información extra sobre los motivos de elegir Intuuchina--}}
    @include('partials._motifs')

    {{--Elemento FOOTER--}}
    @include('partials._footer')
@endsection