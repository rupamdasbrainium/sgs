<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') {{ config('app.name', 'SGS') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
        <!-- Scripts -->
        <script src="{{ asset('public/js/app.js') }}" defer></script>
        <!-- Custom Styles -->
        <link rel="icon" type="{{ asset('public/admin/image/png') }}" href="{{ asset('public/admin/images/favicon.png') }}"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.0/css/all.css">
        <link rel="stylesheet" href="{{ asset('public/admin/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/admin/css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
    </head>
    <body class="admin_content_view">
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        <!-- Custom Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="{{ asset('public/admin/js/select_optiones.js') }}"></script>
        <script src="{{ asset('public/admin/js/custom.js') }}"></script>
    </body>
</html>