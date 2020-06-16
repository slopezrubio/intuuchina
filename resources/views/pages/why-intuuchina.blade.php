@extends('layouts.master')

@section('content')
    @component('components.header')
        @slot('variant', 'stats')
        @slot('header', __('component.header.' . $view_name))
    @endcomponent

    <main id="{{ $view_name }}">
        @component('components.square-grid')
            @slot('items', __('component.square-grids.motifs'))
        @endcomponent
    </main>

    {{--Elemento que muetra información extra sobre los motivos de elegir Intuuchina--}}
{{--    @include('partials._motifs')--}}

    {{--Elemento FOOTER--}}
    @include('partials._footer')
@endsection