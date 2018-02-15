@extends('layouts.app')

@section('css')
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
                <div class="col-sm-6 form-group">
                    <input type="file" accept="image/*" name="img" class="dropify" data-height="335" data-max-file-size="3M">
                </div>

                <div class="col-sm-6 form-group">
                    @foreach ($types as $item)
                        <label>
                            <input type="checkbox" name="type[]"
                                   value="{{ $item['id'] }}" {{ in_array($item['id'], old('type', [])) ? 'checked' : '' }} data-labelauty="{{ $item['name'] }}">
                        </label>
                    @endforeach
                </div>
            </div>

            <button class="btn btn-block btn-success btn-lg">开始制作</button>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $('.dropify').dropify({
            error: {
                'fileSize': '文件太大',
                'fileExtension': '文件格式不对'
            },
            messages: {
                'default': '『拖拽』 或 『点击』 上传图片 <br/><br/>上传图片后请选择右侧 制作类型。<br/><br/>推荐上传 1024*1024 大小的图片',
                'replace': '『拖拽』 或 『点击』 替换图片 <br/><br/>上传图片后请选择右侧 制作类型。<br/><br/>推荐上传 1024*1024 大小的图片',
                'remove':  '删除',
                'error':   '出错了，请刷新重试'
            }
        });
        $(":checkbox").labelauty({ minimum_width: "305px" });
    </script>
@endsection