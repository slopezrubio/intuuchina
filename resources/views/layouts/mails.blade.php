<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>
    <style>
        /* Tipografías */
        @import url('https://fonts.googleapis.com/css?family=Montserrat&display=swap');
    </style>

    <div id="mail">
        @yield('content')
    </div>

    @include('partials.mails._footer')
</body>
</html>