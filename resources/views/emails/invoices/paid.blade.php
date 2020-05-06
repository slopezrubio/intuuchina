@extends('layouts.mails')

@section('title')
{{ __('mails.invoice.paid.title') }}
@endsection

@section('content')

<main>
@component('mail::card', ['fields' => $invoice_details, 'actions' => __('mails.invoice.paid.action'), 'URLs' => [$hosted_invoice]])
    @slot('header')
        {{ __('mails.invoice.paid.title') }}
    @endslot

    @slot('body')
        {!! $message !!}
    @endslot
@endcomponent
</main>

@endsection