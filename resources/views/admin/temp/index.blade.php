@extends('layouts.app')

@section('subTitle', '文件管理')

@section('content')
    <h1 class="text-center">文件管理</h1>

    <ul>
        @foreach($data as $v)
            <li>{{ $v->id }} ---- {{ $v->path }} ------ {{ $v->created_at }}
                <form id="delete-form-{{ $v->id }}" action="{{ url('admin/temp/'.$v->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger btn-xs">删除</button>
                </form>
            </li>
        @endforeach
    </ul>
    {{ $data->links() }}
@endsection