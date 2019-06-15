@extends('layouts.layouts')
@section('title', '后台登录')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/login/normalize.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/login/demo.css')}}" />
    <!--必要样式-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/login/component.css')}}" />
@endsection
@section('content')
    <div class="container demo-1">
        <div class="content">
            <div id="large-header" class="large-header">
                <canvas id="demo-canvas"></canvas>
                <div class="logo_box">
                    <h3>欢迎你</h3>
                    <form action="{{url('/admin/login')}}" name="f" method="post">
                        {{ csrf_field()}}
                        <div class="input_outer">
                            <span class="u_user"></span>
                            <input name="email" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入账户">
                        </div>
                        <div class="input_outer">
                            <span class="us_uer"></span>
                            <input name="password" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;"value="" type="password" placeholder="请输入密码">
                        </div>
                        <div class="mb2"><button class="act-but submit"  style="color: #FFFFFF">登录</button></div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /container -->

@endsection
@section('js')
    <script src="{{asset('js/login/html5.js')}}"></script>
    <script src="{{asset('js/login/TweenLite.min.js')}}"></script>
    <script src="{{asset('js/login/EasePack.min.js')}}"></script>
    <script src="{{asset('js/login/rAF.js')}}"></script>
    <script src="{{asset('js/login/demo-1.js')}}"></script>
@endsection
