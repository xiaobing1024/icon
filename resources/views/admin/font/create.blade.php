@extends('layouts.app')

@section('subTitle', 'Font添加')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}">Home</a></li>
        <li><a href="{{ url('admin/font') }}">Font-Family</a></li>
        <li><a href="{{ url('admin/font/create') }}">Create</a></li>
    </ol>
    <form class="form-horizontal" role="form" method="post" action="{{ url('admin/font') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">文字</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="font" name="font" placeholder="请输入文字内容">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">文字样式</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="font_family" id="lastname" placeholder="请输入文字样式">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">保存</button>
            </div>
        </div>
        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: #f0ad4e;margin-left: 30px;margin-bottom: 10px;">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </form>
@endsection

