@extends('layouts.app')

@section('subTitle', '图标管理')

@section('content')
    <h1 class="text-center">图标管理</h1>
    <a href="{{ url('admin/icon/create') }}">添加</a>

    <ul>
        @foreach($icons as $icon)
            <li>{{ $icon->id }} ---- {{ $icon->name }} <a href="{{ url('admin/icon/'.$icon->id.'/edit') }}">修改</a></li>
        @endforeach
    </ul>
@endsection