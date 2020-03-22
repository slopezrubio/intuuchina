@extends('layouts.master')

@section('content')
    @component('components.header')
        @slot('variant', 'primary')
        @slot('background_image', __('heading.' .$view_name. '.background') )
        @slot('title', __('heading.' .$view_name. '.title'))
    @endcomponent

    <main id="university">
        {{--Incluye los tipos de master ofrecidos--}}
        @include('partials._university-slider')
    </main>

    @include('partials._footer')
@endsection