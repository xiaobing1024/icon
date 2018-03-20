<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="keywords" content="{{ cache_map('keyword', '')  }}">
    <meta name="description" content="{{ cache_map('description', '') }}">
    <meta name="author" content="{{ cache_map('author', '') }}">
    @if (!empty(cache_map('baidu-site-verification', '')))
        <meta name="baidu-site-verification" content="{{ cache_map('baidu-site-verification', '') }}" />
    @endif
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{--<link href="{{ asset('css/all.css') }}" rel="stylesheet">--}}
    <link href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            /* Margin bottom by footer height */
            margin-bottom: 80px;
            font-family: "Helvetica Neue", Helvetica, Arial, "PingFang SC", "Hiragino Sans GB", "Heiti SC", "Microsoft YaHei", "WenQuanYi Micro Hei", sans-serif;
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
        <nav class="navbar navbar-expand-lg navbar-dark bg-success" style="margin-bottom: 20px">
            <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('image/favicon30.png') }}" width="20" height="20" class="d-inline-block align-center" alt="favicon" title="favicon">
                Bingo 图标在线制作
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/') }}">裁剪</a>
                    </li>
                    <li class="nav-item {{ request()->is('*font') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('font') }}">文字图标</a>
                    </li>
                </ul>
            </div>
            </div>
        </nav>

        <main role="main" class="container">
            @include('layouts.alert')

            @if ($errors->any())
            <div class="row">
                <div class="col">
                    <div class="alert alert-danger text-center">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>{{ $errors->first() }}</strong>
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                @yield('content')
            </div>
        </main>

        <footer class="container-fluid footer foot-wrap">
            <p align="center" style="margin-top: 20px;color:#878B91;">
                <a href="http://www.bingoicon.com" target="_blank" style="color: #999;">Copyright © 2018 bingoicon.com</a> | <a href="http://www.miitbeian.gov.cn" target="_blank" style="color: #999;">{{ cache_map('beian', '') }}</a>
            </p>
        </footer>
    </div>
    <!-- Scripts -->
    {{--<script src="{{ asset('js/all.js') }}"></script>--}}
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdn.bootcss.com/vue/2.5.15/vue.min.js"></script>

    @yield('js')
</body>
</html>
