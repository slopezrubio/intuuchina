@extends('layouts.master')

@section('content')
    @component('components.header', [
        'header' => __('component.header.404')
    ])
        @slot('variant', 'error-found')
    @endcomponent

    @include('partials._footer')
@endsection
