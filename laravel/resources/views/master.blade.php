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
        <h1>{{ env('APP_NAME') }}</h1>
        @include('shared.nav')
    </header>
    <div class="main">
        @yield('body')
    </div>
    <footer>
        @include('shared.nav')
        <div class="legal">© {{ date('Y') }} by Web-Opt. All Rights Reserved.</div>
    </footer>
</body>
</html>
