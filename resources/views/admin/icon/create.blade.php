@extends('layouts.app')

@section('subTitle', '添加')

@section('content')
    <h1 class="text-center">添加图标</h1>
    <form action="{{ url('admin/icon') }}" method="post" role="form">
        {{ csrf_field() }}
        @include('admin.icon.form')
        <button type="submit" class="btn btn-primary btn-block">添加</button>
    </form>
@endsection

