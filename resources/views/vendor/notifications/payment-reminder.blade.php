@extends('layouts.mails')

@section('content')
<main>
@if(isset($reminder))
{!! $reminder['body'] !!}
@endif
</main>
@endsection