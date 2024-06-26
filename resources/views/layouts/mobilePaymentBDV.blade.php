<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('images/LOGO COMPLETO TRANSP.png') }}">

    <!-- Scripts -->
    @vite(['resources/sass/puntoYaBDV.scss', 'resources/js/app.js'])
    <meta name="py-client" content="" />

</head>

<body>

    <main>@yield('content')</main>


</body>

</html>
