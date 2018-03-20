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
                {{--@foreach ($types as $item)--}}
                {{--<input type="checkbox" value="{{ $item['id'] }}" v-model="checks" style="display: none">--}}
                {{--@endforeach--}}

                {{--<div class="col-12 col-sm-12 col-md-6 form-group">--}}
                {{--@foreach ($types as $k => $item)--}}
                {{--<button class="btn btn-block btn-md no-hover" v-bind:class="{{ 'class' . $k }}" type="button"--}}
                {{--@click="change('{{ $item['id'] }}')">--}}
                {{--<i class="fa fa-apple"></i> {{ $item['name'] }}</button>--}}
                {{--@endforeach--}}
                {{--</div>--}}
            </div>
            {{--<button class="btn btn-block btn-outline-success btn-lg" type="submit" :disabled="what">开始制作</button>--}}
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

            if (bl) {
                console.log("#btn" + v);
                $("#btn" + v).removeClass('btn-info').addClass('btn-outline-info');
            } else {
                $("#btn" + v).removeClass('btn-outline-info').addClass('btn-info');
            }
            // $("#btn" + v).attr("class", bl ? 'btn btn-block btn-md btn-outline-info' : 'btn btn-block btn-md btn-info');

            $('#go').attr("disabled", !(this.checks.length > 0 && dropify.files.length > 0));
        }

        function fileChange() {
            $('#go').attr("disabled", !(this.checks.length > 0 && dropify.files.length > 0));
        }

        {{--new Vue({--}}
        {{--el: '#app',--}}
        {{--data: {--}}
        {{--checks: [],--}}
        {{--what:true,--}}
        {{--},--}}
        {{--computed: {--}}
        {{--@foreach ($types as $k => $item)--}}
        {{--'{{ 'class' . $k }}': function () {--}}
        {{--bl = this.checks.indexOf('{{ $item['id'] }}') > -1;--}}
        {{--return {--}}
        {{--'btn-outline-info': !bl,--}}
        {{--'btn-info': bl--}}
        {{--}--}}
        {{--},--}}
        {{--@endforeach--}}
        {{--},--}}
        {{--methods: {--}}
        {{--change: function (idx) {--}}
        {{--i = this.checks.indexOf(idx);--}}
        {{--i > -1 ? this.checks.splice(i, 1) : this.checks.push(idx);--}}

        {{--bl = !(this.checks.length > 0 && dropify.files.length > 0);--}}
        {{--this.what = bl;--}}
        {{--},--}}
        {{--fileChange: function () {--}}
        {{--bl = !(this.checks.length > 0 && dropify.files.length > 0);--}}
        {{--this.what = bl;--}}
        {{--}--}}
        {{--}--}}
        {{--});--}}
    </script>
@endsection