<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="keyword" content="{{ cache_map('keyword', '')  }}">
    <meta name="description" content="{{ cache_map('description', '') }}">
    <meta name="author" content="{{ cache_map('author', '') }}">
    @if (!empty(cache_map('baidu-site-verification', '')))
        <meta name="baidu-site-verification" content="{{ cache_map('baidu-site-verification', '') }}" />
    @endif
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <style>
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            /* Margin bottom by footer height */
            margin-bottom: 60px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            /* Set the fixed height of the footer here */
            height: 60px;
            background-color: #f5f5f5;
        }
    </style>
    @yield('css')

    <script>{!! cache_map('baidu_code', '') !!}</script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">--}}
                        {{--<span class="sr-only">Toggle Navigation</span>--}}
                        {{--<span class="icon-bar"></span>--}}
                        {{--<span class="icon-bar"></span>--}}
                        {{--<span class="icon-bar"></span>--}}
                    {{--</button>--}}

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ cache_map('title', config('app.name', 'Laravel')) }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                @include('layouts.alert')
                @if ($errors->any())
                <div class="col-sm-10 col-sm-offset-1 text-center">
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>{{ $errors->first() }}</strong>
                    </div>
                </div>
                @endif

                @yield('content')
            </div>
        </div>

        <footer class="container-fluid footer foot-wrap">
            <p align="center" style="margin-top: 20px;color:#878B91;">
                <a href="http://www.miitbeian.gov.cn" target="_blank" style="color: #999;">{{ cache_map('beian', '') }}</a>
            </p>
        </footer>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/all.js') }}"></script>
    @yield('js')
</body>
</html>
