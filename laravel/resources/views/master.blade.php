<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title> @section('title') {{ env('APP_NAME') }} @show </title>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/google-anal.js') }}" type="text/javascript"></script>
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}">
        </div>
        <nav>
            <a href="/">Home</a> |
            <a href="/clients">Clients</a> |
            <a href="/contact">Contact</a> |
        </nav>
    </header>
    @yield('body')
    <footer>
        <nav>
            <a href="/">Home</a> |
            <a href="/clients">Clients</a> |
            <a href="/contact">Contact</a> |
        </nav>
    </footer>
</body>
</html>
