@extends('layouts.master')

@section('title')
    {{ __('meta.title.' . $view_name) }}
@endsection

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

    {{--Elemento FOOTER--}}
    @include('partials._footer')
@endsection