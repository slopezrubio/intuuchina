@extends('layouts.admin.mails')

@section('title')
    {{ __('mails.new-payment.title') }}
@endsection

@section('content')
<h1 class="notification__heading-1">{{ __('mails.new-payment.title') }}</h1>
<main>
<div class="notification-card">
<div class="notification-card__header">
<h2>{{ __('mails.generics.payment notification') }}</h2>
</div>
<div class="notification-card__body">
{!! $message !!}
<table class="details">
<tr>
<th><p>{{ __('User') }}</p></th>
<td><p>{{ $user->name }} {{ $user->surnames }}</p></td>
</tr>
<tr>
<th><p>{{ __('E-Mail Adress') }}</p></th>
<td><p>{{ $user->email }}</p></td>
</tr>
<tr>
<th><p>{{ __('Program') }}</th>
<td><p>{{ $user->program->name }}</p></td>
</tr>
<tr>
<th><p>{{ __('Phone Number') }}</p></th>
<td><p>{{ App\User::e164NumberFormat($user->phone_number) }}</p></td>
</tr>
<tr>
<th><p>{{ __('Issue') }}</p></th>
<td><p>{{ $user->getFirstCategory()->fee->name }}</td>
</tr>
<tr>
<th><p>{{ __('Amount Received') }}</p></th>
<td><p>{{ $total }}</p></td>
</tr>
</table>
</div>
</div>
</main>
@endsection