@extends('layouts.app')

@section('content')
    <form action="{{ url('make_icon') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" accept="image/*" name="img">

        <ok-checkbox input_name="type[]" :lists="{{ $types }}"></ok-checkbox>

        <button type="submit">确定</button>
    </form>
@endsection