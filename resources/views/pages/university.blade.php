@extends('layouts.master')

@section('content')
    @component('components.header')
        @slot('variant', 'primary')
        @slot('header', __('component.header.university'))
    @endcomponent

    <main id="university">
        {{--Incluye los tipos de master ofrecidos--}}
        @include('partials._university-slider')
    </main>

    @include('partials._footer')
@endsection