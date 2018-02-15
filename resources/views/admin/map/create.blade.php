@extends('layouts.app')

@section('subTitle', '添加')

@section('content')
    <h1 class="text-center">添加配置</h1>
    <form action="{{ url('admin/map') }}" method="post" role="form">
        {{ csrf_field() }}
        @include('admin.map.form')
        <button type="submit" class="btn btn-primary btn-block">添加</button>
    </form>
@endsection