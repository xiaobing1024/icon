@extends('layouts.app')

@section('css')
    <link href="//cdn.bootcss.com/labelauty/1.1.4/jquery-labelauty.min.css" rel="stylesheet">
    <style>
        .ok-box {
            margin-top: 30px;
        }
        button {
            margin-top: 30px;
        }
    </style>
@endsection

@section('content')
    <div class="col-sm-10 col-sm-offset-1 ok-box">
        <form action="{{ url('make_icon') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-6">
                    <input type="file" accept="image/*" name="img">
                </div>

                <div class="col-sm-6">
                    @foreach ($types as $item)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="type[]"
                                       value="{{ $item['id'] }}" {{ in_array($item['id'], old('type', [])) ? 'checked' : '' }} data-labelauty="{{ $item['name'] }}">
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button class="btn btn-block btn-success btn-lg">开始制作</button>
        </form>
    </div>
@endsection

@section('js')
    <script src="//cdn.bootcss.com/labelauty/1.1.4/jquery-labelauty.min.js"></script>
    <script>
        $(":checkbox").labelauty({ minimum_width: "305px" });
    </script>
@endsection