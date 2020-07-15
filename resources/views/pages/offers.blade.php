@extends('layouts.master')

@section('title')
    @if(request()->query('page') !== null)
        {{ __('meta.title.' . $view_name . '.paginator', ['current' => $offers->currentPage(), 'last' => $offers->lastPage()]) }}
    @else
        {{ __('meta.title.' . $view_name . '.default') }}
    @endif
@endsection

@section('description')
    @if(request()->query('page') !== null)
        <meta name="description" content="{{ __('meta.description.' . $view_name . '.paginator', ['current' => $offers->currentPage()]) }}">
    @else
        <meta name="description" content="{{ __('meta.description.' . $view_name . '.default') }}">
    @endif
@endsection

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