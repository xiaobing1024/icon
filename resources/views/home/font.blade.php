@extends('layouts.app')

@section('css')
    <link href="https://cdn.bootcss.com/select2/4.0.6-rc.1/css/select2.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="col-12 col-sm-12 col-md-6 form-group">
        <div class="text-center" width="256" height="256">
            <canvas id="draw" width="256" height="256"></canvas>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6">
        <form>
            <div class="form-group row">
                <label for="backgroundColor" class="col-xl-2 col-form-label">
                    <a href="http://www.sioe.cn/yingyong/yanse-rgb-16/" data-toggle="tooltip" data-placement="right" title="点击查看提示"
                       target="_Blank">背景色</a>
                </label>
                <div class="col-xl-4">
                    <input type="text" id="backgroundColor" class="form-control" placeholder="图标背景色"
                           v-model="backgroundColor">
                </div>

                <label for="textColor" class="col-xl-2 col-form-label">
                    <a href="http://www.colorhunt.co/" data-toggle="tooltip" data-placement="right" title="点击查看提示"
                       target="_Blank">文字颜色</a>
                </label>
                <div class="col-xl-4">
                    <input type="text" id="textColor" class="form-control" placeholder="文字颜色" v-model="textColor">
                </div>
            </div>

            <div class="form-group row">
                <label for="text" class="col-xl-2 col-form-label">文字</label>
                <div class="col-xl-4">
                    <input type="text" id="text" class="form-control" placeholder="图标中的文字" v-model="text">
                </div>

                <label for="font_family" class="col-xl-2 col-form-label">字体</label>
                <div class="col-xl-4">
                    <select name="font_family" id="font_family" class="form-control" v-model="font_family">
                        @foreach ($font as $item)
                            <option value="{{ $item->font_family }}">{{ $item->font }}</option>
                        @endforeach
                    </select>
                    {{--<input type="text" id="font_family" class="form-control" placeholder="字体" v-model="font_family">--}}
                </div>
            </div>

            <div class="form-group row">
                <label for="font_size" class="col-xl-2 col-form-label">字体大小</label>
                <div class="col-xl-4">
                    <input type="number" id="font_size" class="form-control" placeholder="字体大小 单位px"
                           v-model="font_size">
                </div>

                <label for="font_weight" class="col-xl-2 col-form-label">字体粗细</label>
                <div class="col-xl-4">
                    <select name="font_weight" id="font_weight" class="form-control" v-model="font_weight">
                        <option value="normal">normal</option>
                        <option value="bold">bold</option>
                        <option value="bolder">bolder</option>
                        <option value="lighter">lighter</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                        <option value="400">400</option>
                        <option value="500">500</option>
                        <option value="600">600</option>
                        <option value="700">700</option>
                        <option value="800">800</option>
                        <option value="900">900</option>
                    </select>
                    {{--<input type="text" id="font_weight" class="form-control" placeholder="字体粗细" v-model="font_weight">--}}
                </div>
            </div>


            <div class="form-group row">
                <label for="text_x" class="col-xl-2 col-form-label">中心-X</label>
                <div class="col-xl-4">
                    <input type="number" id="text_x" class="form-control" placeholder="128为中点" v-model="text_x">
                </div>

                <label for="text_y" class="col-xl-2 col-form-label">中心-Y</label>
                <div class="col-xl-4">
                    <input type="number" id="text_y" class="form-control" placeholder="128为中点" v-model="text_y">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12 mt-3">
                    <a class="btn btn-block btn-outline-success btn-lg" id="go">
                        <i class="fa fa-picture-o"></i> 下载图片
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="text-center" width="1024" height="1024" style="display: none">
        <canvas id="drawcopy" width="1024" height="1024"></canvas>
    </div>
@endsection

@section('js')
    <script src="https://cdn.bootcss.com/select2/4.0.6-rc.1/js/select2.min.js"></script>
    <script src="https://cdn.bootcss.com/select2/4.0.6-rc.1/js/i18n/zh-CN.js"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        new Vue({
            el: '#app',
            mounted: function () {
                this.drawc();
            },
            data: {
                text: 'f',
                backgroundColor: '#3b5998',
                font_size: 300,
                font_family: 'Verdana',
                font_weight: 'normal',
                textColor: '#ffffff',
                text_x: 148,
                text_y: 160,
            },
            methods: {
                drawc: function () {
                    ctx = draw.getContext("2d");

                    ctx.fillStyle = this.backgroundColor;
                    ctx.fillRect(0, 0, 256, 256);

                    ctx.fillStyle = this.textColor;
                    ctx.font = this.font_weight + " " + this.font_size + "px " + this.font_family;

                    ctx.textBaseline = "middle";
                    ctx.textAlign = "center";
                    ctx.fillText(this.text, this.text_x, this.text_y);


                    ctx = drawcopy.getContext("2d");

                    ctx.fillStyle = this.backgroundColor;
                    ctx.fillRect(0, 0, 1024, 1024);

                    ctx.fillStyle = this.textColor;
                    ctx.font = this.font_weight + " " + (this.font_size * 4) + "px " + this.font_family;

                    ctx.textBaseline = "middle";
                    ctx.textAlign = "center";
                    ctx.fillText(this.text, this.text_x * 4, this.text_y * 4);

                    go.href = drawcopy.toDataURL("image/png");
                    go.download = "icon.png";
                }
            },
            watch: {
                text: function () {
                    this.drawc();
                },
                backgroundColor: function () {
                    this.drawc();
                },
                font_size: function () {
                    this.drawc();
                },
                font_family: function () {
                    this.drawc();
                },
                font_weight: function () {
                    this.drawc();
                },
                textColor: function () {
                    this.drawc();
                },
                text_x: function () {
                    this.drawc();
                },
                text_y: function () {
                    this.drawc();
                },
            }
        });
    </script>
@endsection
