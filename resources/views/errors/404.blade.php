@extends('layouts.app')

@section('title', '页面不存在')

@section('content')
    <div class="text-center">
        <h1>404</h1>
        <h3><a href="{{ url('/') }}">回到首页</a></h3>
    </div>
@endsection