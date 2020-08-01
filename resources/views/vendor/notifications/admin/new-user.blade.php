@extends('layouts.admin.mails')

@section('title')
    {{ __('mails.admin.new-user.title') }}
@endsection

@section('content')
<main>
{!! __('mails.admin.new-user.body', ['program' => $user->program->name]) !!}

@component('mail::card', ['fields' => [
    __('First Name') => $user->name,
    __('Surnames') => $user->surnames,
    __('E-Mail Address') => $user->email,
    __('Nationality') => $user->nationality,
    __('Phone Number') => App\User::e164NumberFormat($user->phone_number),
    __('Program Interested') => $user->program->name,
    __('Resume') => $user->cv !== null ? __('Attached') : __('Not Provided')
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