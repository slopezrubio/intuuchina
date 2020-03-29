@extends('layouts.master')

@section('content')
    @component('components.header')
        @slot('variant', 'primary')
        @slot('header', __('component.header.offers'))
    @endcomponent

    <main id="job-board" class="container-fluid">
        {{-- Tabla de ofertas --}}
        @include('partials._offers-list')
    </main>

    @include('partials._footer')

@endsection