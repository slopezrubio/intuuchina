@extends('layouts.mails')

@section('content')
    <main>
        <h1>{{ $msg['subject'] }}</h1>
    </main>

    @include('partials.mails._footer')

@endsection
