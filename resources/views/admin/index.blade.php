@extends('layouts.app')

@section('content')
    <ul>
        <li><a href="{{ url('admin/type') }}">类别管理</a></li>
        <li><a href="{{ url('admin/icon') }}">图标管理</a></li>
        <li><a href="{{ url('admin/temp') }}">文件管理</a></li>
    </ul>
@endsection