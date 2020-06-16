@extends('layouts.master')

@section('content')
    @component('components.header', ['header' => [
        'background' => asset('storage/images/headers/errors/419-random-picture_0.jpg'),
        'error-message' => isset($exception) ? $exception->getStatusCode() . ' — ' . __('The page you requested has expired') : __('The page you requested has expired'),
    ]])
        @slot('variant', 'error-found')
    @endcomponent

    @include('partials._footer')
@endsection