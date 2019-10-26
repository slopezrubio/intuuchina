@extends('layouts.mails')

@section('content')
    <main>
        <h1>Welcome to IntuuChina</h1>
        <p>
            Dear {{ $user['name'] }},
        </p>
        <p>
            Thank you for contacting us. It's a pleasure to receive your application for our {{ $user['program'] }} program. My name is Patrick and my job is to advise and guide you throughout our selection process and hopefully greeting you in person in China.
            The first step is to send me your CV in English. The next step will be talking to one of our Educational or Career counselors. We will cover the following:
            1) Your expectations for the program
            2) Your dates of arrival and other logistics issues
            3) How to best prepare before the program
            4) Your professional and academic experience

        </p>
        <p>
            After a first assessment, we will contact you to let you know if you are eligible for the program.
        </p>
        <p>
            Do you think you could send me the CV within today?
        </p>
        <p>
            All the best.
        </p>
    </main>

    @include('partials.mails._footer')
@endsection
