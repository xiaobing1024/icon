@extends('layouts.app')

@section('subTitle', '修改')

@section('content')
    <h1 class="text-center">修改分类</h1>
    <form action="{{ url('admin/type/'.$data['id']) }}" method="post" role="form">
        {{ method_field('put') }}
        {{ csrf_field() }}
        <input type="text" hidden value="{{ $data['id'] }}" name="id">
        @include('admin.type.form')
        <button type="submit" class="btn btn-primary btn-block">修改</button>
    </form>
@endsection