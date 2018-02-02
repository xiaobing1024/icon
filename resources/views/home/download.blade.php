@extends('layouts.app')

@section('css')
    <style>
        a {
            margin-top: 30px;
        }
    </style>
@endsection

@section('content')
    <div class="col-sm-10 col-sm-offset-1">
        @if (session()->has('path') && \Storage::disk('zip')->exists(session('path')))
            <a href="{{ url('/d/'.session('path')) }}" class="btn btn-block btn-lg btn-success">下载</a>
        @endif
        <a href="{{ url('/') }}" class="btn btn-block btn-lg btn-primary">返回主页</a>
    </div>
@endsection