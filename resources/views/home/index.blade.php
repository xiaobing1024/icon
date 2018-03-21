@extends('layouts.app')

@section('content')
    <div class="col">
        <form action="{{ url('make_icon') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 form-group">
                    <input type="file" name="img" id="dropify" class="dropify"
                           data-height="335" data-max-file-size="3M" onchange="fileChange()">
                </div>

                @foreach ($types as $item)
                    <input type="checkbox" name="type[]" value="{{ $item['id'] }}" id="{{ 'checkbox'.$item['id'] }}" style="display: none">
                @endforeach

                <div class="col-12 col-sm-12 col-md-6 form-group">
                    @foreach ($types as $k => $item)
                        <button type="button" class="btn btn-block btn-md btn-outline-info" id="{{ 'btn' . $item['id'] }}" onclick="btn_change('{{ $item['id'] }}')">
                            <i class="{{ $item['icon'] }}"></i> {{ $item['name'] }}
                        </button>
                    @endforeach
                </div>
            </div>
            <button class="btn btn-block btn-outline-success btn-lg" id="go" type="submit" disabled>开始制作</button>
        </form>
    </div>
@endsection

@section('js')
    <script>
        var drEvent = $('.dropify').dropify({
            error: {
                'fileSize': '文件太大',
                'fileExtension': '文件格式不对'
            },
            messages: {
                'default': '『拖拽』 或 『点击』 上传图片 <br/><br/>上传图片后请选择右侧 制作类型。<br/><br/>推荐上传 1024*1024 大小的图片',
                'replace': '『拖拽』 或 『点击』 替换图片 <br/><br/>上传图片后请选择右侧 制作类型。<br/><br/>推荐上传 1024*1024 大小的图片',
                'remove': '删除',
                'error': '出错了，请刷新重试'
            }
        });

        drEvent.on('dropify.afterClear', function (event, element) {
            fileChange();
        });

        drEvent.on('dropify.errors', function (event, element) {
            fileChange();
            alert('出错了，刷新重试');
        });

        checks = [];

        function btn_change(v) {
            i = $("#checkbox" + v);

            bl = i.is(':checked');

            bl ? checks.splice(checks.indexOf(v), 1) : checks.push(v);

            i.prop("checked", !bl);

            btn = $("#btn" + v);
            if (bl) {
                btn.css('color', '#17a2b8');
                btn.css('background-color', 'transparent');
                btn.css('background-image', 'none');
                btn.css('border-color', '#17a2b8');
            } else {
                btn.css('color', '#fff');
                btn.css('background-color', '#17a2b8');
                btn.css('border-color', '#17a2b8');
            }

            $('#go').attr("disabled", !(this.checks.length > 0 && dropify.files.length > 0));
        }

        function fileChange() {
            $('#go').attr("disabled", !(this.checks.length > 0 && dropify.files.length > 0));
        }
    </script>
@endsection