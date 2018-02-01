@extends('layouts.app')

@section('content')
    <div class="col-sm-10 col-sm-offset-1">
        <form action="{{ url('make_icon') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" accept="image/*" name="img">

            @foreach ($types as $item)
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="type[]" value="{{ $item['id'] }}"> {{ $item['name'] }}
                    </label>
                </div>
            @endforeach

            <button class="btn btn-block btn-success btn-lg">开始制作</button>
        </form>
    </div>
@endsection