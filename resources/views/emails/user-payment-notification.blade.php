@extends('layouts.mails')

@section('content')
    <main>
        {!!  __('mails.bodies.user payment notification', ['user' => $user, 'amount' => $intent->amount, 'concept_of_payment' => $intent->description]) !!}
    </main>
@endsection