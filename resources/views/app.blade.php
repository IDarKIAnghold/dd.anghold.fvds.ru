<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title inertia>{{ config('app.name') }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">

    <!-- Actual stylesheet links -->
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

</head>

<body>
    <header class="sticky-top" style="top: 0; z-index:1050" id="navigation"></header>

    <main class="wrapper">
        <div class="mt-5 mb-5 ps-3 pe-3">
            <div class="container-xxl py-4 main" id="main">@inertia</div>
        </div>
    </main>

    <div class="modal fade">
        <div class="modal-content"></div>
    </div>

    <footer class="site-footer mt-5" id="footer"></footer>

    @routes
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @vite(['resources/js/app.js'])
    @vite(["resources/js/Pages/{$page['component']}.vue"])
</body>

</html>
