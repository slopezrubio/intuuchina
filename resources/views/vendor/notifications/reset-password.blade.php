@extends('layouts.mails')

@section('title')
{{ __('notification.reset-password.title') }}
@endsection

@section('content')
<main>
{!! __('notification.reset-password.body.greeting', ['name' => $user->name]) !!}
@component('mail::cta', ['URLs' => [url('password/reset', $token)], 'actionText' => [trans('Reset Password')]])
@endcomponent
{!! __('notification.reset-password.body.message') !!}
{!! __('notification.reset-password.body.farewell') !!}
</main>
@endsection