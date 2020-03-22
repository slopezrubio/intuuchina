@extends('layouts.admin.mails')

@section('title')
    {{ __('mails.visitor-query.title') }}
@endsection

@section('content')
    <main>
        @component('mail::card', ['fields' => $queryDetails])
            @slot('header')
                {{ __('mails.visitor-query.title') }}
            @endslot

            @slot('body')
                {!! $message !!}
            @endslot
        @endcomponent
    </main>
@endsection
