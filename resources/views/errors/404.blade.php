@extends('layouts.master')

@section('content')
    @component('components.header', ['header' => [
        'background' => asset('storage/images/headers/errors/404-random-picture_'.$curiosity_card_key.'.jpg'),
        'error-message' => $exception->getStatusCode() . ' — ' . __('The page you requested is not available or is no longer published'),
    ]])
        @slot('variant', 'error-found')
        @slot('card', __('component.curiosity-cards.404')[$curiosity_card_key])
    @endcomponent

    @include('partials._footer')
@endsection
