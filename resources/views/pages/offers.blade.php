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
        <section id="search-tool">
            @component('components.toolbars.job-board')

            @endcomponent
        </section>

        <section id="content">
            {{-- Tabla de ofertas --}}
            @include('partials._offers-list')
        </section>

    </main>

    @include('partials._footer')

@endsection