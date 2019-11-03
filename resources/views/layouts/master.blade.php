<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Permite la visualización en dispositivos móviles -->
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>

    <!-- Título de la aplicación -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- reCAPCTCHA v2.0 de Google -->
    <script src='https://www.google.com/recaptcha/api.js?hl={{ App::getLocale() }}' async defer></script>

    <!-- Favicon -->
    @include('partials/_favicon')

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/solid.min.css') }}">
    <script src="{{ asset('fontawesome/js/fontawesome.min.js') }}"></script>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">


    <!-- Estilos de la aplicación -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/lib/style.css')}}">
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('js/lib/main.js') }}"></script>
</body>
</html>
