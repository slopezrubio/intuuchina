@extends('layouts.mails')

@section('title')
{{ __('mails.invoice.paid.title') }}
@endsection

@section('content')

<main>
@component('mail::card', ['fields' => $invoiceDetails, 'actions' => __('mails.invoice.paid.action'), 'URLs' => [$hostedInvoice]])
    @slot('header')
        {{ __('mails.invoice.paid.title') }}
    @endslot

    @slot('body')
        {!! $message !!}
    @endslot
@endcomponent
</main>

@endsection