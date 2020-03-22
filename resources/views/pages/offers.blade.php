@extends('layouts.master')

@section('content')
    @component('components.header')
        @slot('variant')
            {{ 'primary' }}
        @endslot

        @slot('background_image')
            {{ __('heading.' .$view_name. '.background') }}
        @endslot

        @slot('title')
            {!!  __('heading.' .$view_name. '.title') !!}
        @endslot
    @endcomponent

    <main id="job-board" class="container-fluid">
        {{-- Tabla de ofertas --}}
        @include('partials._offers-list')
    </main>

    @include('partials._footer')

@endsection