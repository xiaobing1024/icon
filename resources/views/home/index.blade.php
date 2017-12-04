@extends('layouts.app')

@section('content')
    <form action="{{ url('make_icon') }}" method="post" enctype="multipart/form-data">
        <input type="file" accept="image/*">

        <button type="submit">确定</button>
    </form>
@endsection