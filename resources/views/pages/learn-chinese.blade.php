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

    <main id="learn-chinese">
        {{--Incluye los tipos de cursos ofrecidos--}}
        @include('partials._chinese-courses')

        @include('partials._price-course-info')
    </main>
    @include('partials._footer')
@endsection