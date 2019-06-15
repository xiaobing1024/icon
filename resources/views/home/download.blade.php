@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="col">
        @if (session()->has('path') && \Storage::disk('zip')->exists(session('path')))
            <a href="{{ url('/d/'.session('path')) }}" class="btn btn-block btn-lg btn-outline-success mb-3"><i
                        class="fa fa-download"></i> 下载</a>
        @endif
        <div>
            <a href="{{ url('/') }}" class="btn btn-block btn-lg btn-outline-primary"><i class="fa fa-home"></i> 返回主页</a>
        </div>
    </div>
@endsection