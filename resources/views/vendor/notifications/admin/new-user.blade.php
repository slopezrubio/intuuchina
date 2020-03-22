@extends('layouts.admin.mails')

@section('title')
    {{ __('mails.admin.new-user.title') }}
@endsection

@section('content')
<main>
{!! $body !!}
@component('mail::card', ['fields' => [
    __('content.first name') => $user->name,
    __('content.surnames') => $user->surnames,
    __('content.nationality') => $user->nationality,
    __('content.phone number') => $user->getPrefixedPhoneNumber(),
    __('content.program') => __('content.programs.' . $user->program),
    __('content.resume') => $user->cv !== null ? __('content.attached') : __('content.not provided')
]])
    @slot('header')
        {{ __('mails.admin.new-user.title') }}
    @endslot

    @slot('body')
        {!! __('mails.admin.new-user.card.body') !!}
    @endslot
@endcomponent
</main>
@endsection