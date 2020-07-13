<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials._analytics')

    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Canonical Links -->
    <link rel="canonical" href="{{ __('meta.canonical.home') }}">

    <!-- Permite la visualización en dispositivos móviles -->
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>

    <!-- Título de la aplicación -->
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- reCAPCTCHA v2.0 de Google -->
    <script src='https://www.google.com/recaptcha/api.js?hl={{ app()->getLocale() }}' async defer></script>

    <!-- Favicon -->
    @include('partials/_favicon')

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
{{--    <script src="https://code.jquery.com/jquery-3.4.1.min.js"crossorigin="anonymous"></script>--}}

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/solid.min.css') }}">
    <script src="{{ asset('fontawesome/js/fontawesome.min.js') }}"></script>

    <!-- Libreria de Stripe -->
    <script src="https://js.stripe.com/v3"></script>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    <!-- Estilos de la aplicación -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lib/style.css') }}">
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <script src="{{ asset('/js/vendor.js') }}"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
