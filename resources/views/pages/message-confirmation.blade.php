@extends('layouts.master')

@section('content')
    @include('partials._nav')
    <div class="container-fluid confirmation">
        <div class="confirmation_content">
            <h1 class="confirmation_title">We already have got your consult</h1>
            <p>
                As soon as we could we will attend to it. Feel free to keep surfing to our website.
            </p>
            <p>
                Our servers should have sent you an email confirming we received your request.
                Please report to us, if this otherwise haven't occurred.
            </p>
            <button class="confirmation_more_info">More information</button>
        </div>
    </div>
    @include('partials._footer')
@endsection

