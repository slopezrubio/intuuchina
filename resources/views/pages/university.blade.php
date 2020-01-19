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

    <main id="university">
        {{--Incluye los tipos de master ofrecidos--}}
        @include('partials._university-slider')
    </main>

    @include('partials._footer')
@endsection