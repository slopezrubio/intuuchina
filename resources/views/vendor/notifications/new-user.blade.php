@extends('layouts.mails')

@section('title')
{{ __('mails.new-user.title') }}
@endsection

@section('content')
<main>
@switch($user->program->value)
@case('internship')
@case('inter_relocat')
{!! __('mails.new-user.body.internship.greeting', ['name' => $user->name]) !!}
{!! __('mails.new-user.body.internship.message') !!}
@component('mail::cta', ['URLs' => $URLs, 'actionText' => __('mails.new-user.action')])
@endcomponent
{!! __('mails.new-user.body.internship.closing') !!}
{!! __('mails.new-user.body.internship.farewell') !!}
@break
@default
{!! __('mails.new-user.body.' . $user->program->value . '.greeting', ['name' => $user->name]) !!}
{!! __('mails.new-user.body.' . $user->program->value . '.message') !!}
@component('mail::cta', ['URLs' => $URLs, 'actionText' => __('mails.new-user.action')])
@endcomponent
{!! __('mails.new-user.body.' . $user->program->value . '.closing') !!}
{!! __('mails.new-user.body.' . $user->program->value . '.farewell') !!}
@break
@endswitch
</main>
@endsection
