@extends('layouts.master')

@section('content')

    @component('components.header')
        @slot('variant', 'secondary h-100')

        @slot('header', [
            'background' => __('component.header.user.welcome.background'),
        ])

        @slot('dialog', 'partials.dialogs.user._verified')
    @endcomponent
@endsection
