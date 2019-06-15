@extends('layouts.app')

@section('subTitle', '添加')

@section('content')
    <h1 class="text-center">添加分类</h1>
    <form action="{{ url('admin/type') }}" method="post" role="form">
        {{ csrf_field() }}
        @include('admin.type.form')
        <button type="submit" class="btn btn-primary btn-block">添加</button>
    </form>
@endsection