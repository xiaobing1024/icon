<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{--<!-- Global site tag (gtag.js) - Google Analytics -->--}}
{{--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117839117-1"></script>--}}
{{--<script>--}}
  {{--window.dataLayer = window.dataLayer || [];--}}
  {{--function gtag(){dataLayer.push(arguments);}--}}
  {{--gtag('js', new Date());--}}

  {{--gtag('config', 'UA-117839117-1');--}}
{{--</script>--}}

    {{--<meta name="google-site-verification" content="r4-vfzpf3m7R1Ta2iU7Y_qBr1BfiDL_p3f43tmTCpbc" />--}}
    {{--<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>--}}
{{--<script>--}}
  {{--(adsbygoogle = window.adsbygoogle || []).push({--}}
    {{--google_ad_client: "ca-pub-7993187458767611",--}}
    {{--enable_page_level_ads: true--}}
  {{--});--}}
{{--</script>--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="baidu_union_verify" content="3592b83376b1d9d57488bec11f34ded9">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@yield('meta')
{{--    @if (!empty(cache_map('baidu-site-verification', '')))--}}
        <meta name="baidu-site-verification" content="oGsJxDX1Zh" />
    {{--@endif--}}
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
@yield('title')
    <!-- Styles -->
    <link href="https://lib.baomitu.com/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://lib.baomitu.com/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet">
    <link href="https://lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
            line-height: 60px;
            background-color: #f5f5f5;
        }
    </style>
    @yield('css')

    <script>var _hmt=_hmt || [];(function(){var hm=document.createElement("script");hm.src="https://hm.baidu.com/hm.js?a532db83c8fe9adc4e6098715809c36c";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm,s);})();</script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success" style="margin-bottom: 20px">
            <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('image/favicon30.png') }}" width="20" height="20" class="d-inline-block align-center" alt="favicon" title="favicon">
                BingoIcon 图标在线制作
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
                    <li class="nav-item" style="visibility: hidden">
                        <a class="nav-link" href="{{ url('cp') }}">caipiaozhushou</a>
                    </li>
                    {{--<li class="nav-item" style="visibility: hidden">--}}
                        {{--<a class="nav-link" href="http://www.xintaikeji.cn/" target="_blank">鑫泰科技</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item" style="visibility: hidden">--}}
                        {{--<a class="nav-link" href="https://www.haoyangmaob.com/" target="_blank">薅羊毛吧</a>--}}
                    {{--</li>--}}
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

        <footer class="footer">
            <div class="container text-center">
                <span class="text-muted small"> &copy; </span><a class="text-muted small" href="http://www.bingoicon.com" target="_blank">www.bingoicon.com</a>
            </div>
        </footer>
    </div>

    <script src="https://lib.baomitu.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://lib.baomitu.com/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://lib.baomitu.com/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://lib.baomitu.com/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://lib.baomitu.com/vue/2.5.15/vue.min.js"></script>

    @yield('js')
</body>
</html>
