<!DOCTYPE html>
<html>
<head>
    <title>
        @section('title')
            {{ env('APP_NAME') }}
        @show
    </title>
    @yield('head')
</head>
<body>
    <script>
        // google anal
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-10189458-10', 'auto');
        ga('send', 'pageview');
    </script>

@yield('body')

</body>
</html>
