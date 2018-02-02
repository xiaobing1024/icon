@extends('layouts.app')

@section('content')
    <ul>
        <li><a href="{{ url('admin/type') }}">类别管理</a></li>
        <li><a href="{{ url('admin/icon') }}">图标管理</a></li>
        <li><a href="{{ url('admin/temp') }}">文件管理</a></li>
        <li><a href="#" onclick="event.preventDefault();document.getElementById('cache-form').submit();">更新缓存</a>
            <form id="cache-form" action="{{ url('admin/refresh_cache') }}" style="display: none;"></form>
        </li>
    </ul>
@endsection