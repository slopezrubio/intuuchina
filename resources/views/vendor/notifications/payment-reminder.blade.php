@extends('layouts.mails')

@section('content')
<main>
@if(isset($reminder))
{!! $reminder['body'] !!}
@endif
@component('mail::cta', ['URLs' => [$action], 'actionText' => __('mails.payment-reminder.action')])
@endcomponent
</main>
@endsection