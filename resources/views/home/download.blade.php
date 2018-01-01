@extends('layouts.app')

@section('content')
    @if (session()->has('path') && \Storage::disk('zip')->exists(session('path')))
        <a href="{{ url('/d/'.session('path')) }}" class="btn btn-block btn-lg btn-success">下载</a>
    @endif
    <a href="{{ url('/') }}" class="btn btn-block btn-lg btn-primary">继续上传</a>
@endsection