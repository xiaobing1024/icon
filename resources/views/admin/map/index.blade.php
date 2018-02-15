@extends('layouts.app')

@section('subTitle', '配置管理')

@section('content')
    <h1 class="text-center">配置管理</h1>
    <a href="{{ url('admin/map/create') }}">添加</a>

    <ul>
        @foreach($maps as $map)
            <li>{{ $map->key }} ---- {{ $map->value }} <a href="{{ url('admin/map/'.$map->id.'/edit') }}">修改</a></li>
        @endforeach
    </ul>
@endsection