@extends('layouts.master')

@section('title')
    {{ __('meta.title.index') }}
@endsection

@section('content')
    @component('components.header')
        @slot('variant', 'secondary')
        @slot('header', __('component.header.home'))

        @slot('input', [
            'name' => 'cta-button',
            'variant' => 'primary',
            'href' => route('internship'),
            'content' => __('Open Positions'),
            'fas' => 'chevron-right'
        ])
    @endcomponent

    <main id="home">
        {{--Elemento Medios de TV--}}
        @include('partials._press')

        {{--Sección de los servicios ofrecidos--}}
        @include('partials._services')

        {{--Infografia del «Customer Journey»--}}
        @include('partials._customer-journey')

        {{--Elemento de los testiomonios que han sido asesorados por Intuuchina--}}
        @include('partials._testimonials')
    </main>

    {{--Elemento FOOTER--}}
    @include('partials._footer')
@endsection
