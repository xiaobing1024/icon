@extends('layouts.app')

@section('subTitle', '文件管理')

@section('content')
    <h1 class="text-center">文件管理</h1>
    <div class="col-xs-4">
        <h3>数据库缓存</h3>
        <ul>
            @foreach($data as $v)
                <li>{{ $v->id }} --- {{ $v->path }} --- {{ $v->created_at }}
                    <form id="delete-form-{{ $v->id }}" action="{{ url('admin/temp/'.$v->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger btn-xs">删除</button>
                    </form>
                </li>
            @endforeach
        </ul>
        {{ $data->links() }}
    </div>

    <div class="col-xs-4">
        <h3>zip文件缓存</h3>
        <ul>
            @foreach($zips as $v)
                <li>{{ $v->file_name }} --- {{ $v->updated_at }}
                    <form action="{{ url('admin/temp/delete_path') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <input type="hidden" name="path" value="{{ $v->file_name }}">
                        <input type="hidden" name="type" value="zip">
                        <button type="submit" class="btn btn-danger btn-xs">删除</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="col-xs-4">
        <h3>上传文件缓存</h3>
        <ul>
            @foreach($icons as $v)
                <li>{{ $v->file_name }} --- {{ $v->updated_at }}
                    <form action="{{ url('admin/temp/delete_path') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <input type="hidden" name="path" value="{{ $v->file_name }}">
                        <input type="hidden" name="type" value="icon">
                        <button type="submit" class="btn btn-danger btn-xs">删除</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>

@endsection