@extends('layouts.master')

@section('content')
    @component('components.header')
        @slot('variant', 'primary')
        @slot('header', __('component.header.' . $view_name))
    @endcomponent

    <main id="learn-chinese">
        {{--Incluye los tipos de cursos ofrecidos--}}
        @include('partials._chinese-courses')

        @include('partials._price-course-info')
    </main>
    @include('partials._footer')
@endsection