<!doctype html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <link rel="stylesheet" media="screen" type="text/css" href="{{ elixir('css/app.css') }}"/>

    @yield('css')

    @yield('head')
</head>
<body>
@section('body')
    @include('partials.topbar')

    <div class="container" id="site">
        <div class="row">
            @yield('fullcontent')
        </div>
    </div>
    <div class="container" id="footer">
        @include('partials.footer')
    </div>
@show

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ elixir('js/app.js') }}"></script>
@yield('js')
</body>
</html>
