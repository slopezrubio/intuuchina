@extends('layouts.mails')

@section('title')
{{ __('mails.new-user.title') }}
@endsection

@section('content')
<main>
{!! __('mails.new-user.body.' . $user->program->value . '.greeting', ['name' => $user->name]) !!}
{!! __('mails.new-user.body.' . $user->program->value . '.message') !!}
@component('mail::cta', ['URLs' => $URLs, 'actionText' => __('mails.new-user.action')])
@endcomponent
{!! __('mails.new-user.body.' . $user->program->value . '.closing') !!}
{!! __('mails.new-user.body.' . $user->program->value . '.farewell') !!}
</main>
@endsection
