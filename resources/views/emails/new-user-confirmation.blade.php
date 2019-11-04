@extends('layouts.mails')

@section('content')
    <main>
        <h1>{{ $title }}</h1>
        {!! __('mails.bodies.new user ' . $user['program'], ['name' => $user['name']]) !!}
    </main>


@endsection
