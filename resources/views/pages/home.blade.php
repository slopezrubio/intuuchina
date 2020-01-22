@extends('layouts.master')

@section('content')
    @component('components.header', ['href' => route('internship')])
        @slot('variant')
            {{ 'secondary' }}
        @endslot

        @slot('background_image')
            {{ __('heading.' .$view_name. '.background') }}
        @endslot

        @slot('cta')
            {{ __('content.open positions') }}
        @endslot

        @slot('title')
            {!!  __('heading.' .$view_name. '.title') !!}
        @endslot
    @endcomponent

    <main id="home">
        {{--Elemento Medios de TV--}}
        @include('partials._news')

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
