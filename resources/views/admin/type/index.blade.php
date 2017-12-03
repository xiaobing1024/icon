@extends('layouts.app')

@section('subTitle', '分类管理')

@section('content')
    <h1 class="text-center">分类管理</h1>
    <a href="{{ url('admin/type/create') }}">添加</a>

    <ul>
        @foreach($types as $type)
            <li>{{ $type->id }} ---- {{ $type->name }} <a href="{{ url('admin/type/'.$type->id.'/edit') }}">修改</a></li>
        @endforeach
    </ul>
@endsection