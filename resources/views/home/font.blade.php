@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="col-12 col-sm-12 col-md-6 form-group">
        <div class="center-block" style="width: 300px; height: 300px">
            <canvas id="draw" style="width: 300px; height: 300px; border-radius: 10px"></canvas>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6">
        <form class="form-inline">
            <div class="form-group">
                <label for="backgroundColor" class="mr-2">背景色</label>
                <input type="text" id="backgroundColor" class="form-control" placeholder="图标背景色" v-model="backgroundColor">
            </div>

            <div class="form-group">
                <label for="text" class="mr-2">文字</label>
                <input type="text" id="text" class="form-control" placeholder="图标中的文字" v-model="text">
            </div>

            <div class="form-group">
                <label for="font_family" class="mr-2">文字颜色</label>
                <input type="text" id="font_family" class="form-control" placeholder="文字颜色" v-model="textColor">
            </div>

            <div class="form-group">
                <label for="font_size" class="mr-2">文字大小</label>
                <input type="text" id="font_size" class="form-control" placeholder="文字大小" v-model="font_size">
            </div>

            <div class="form-group">
                <label for="text_x" class="mr-2">文字中心点位置</label>
                <input type="text" id="text" class="text_x" placeholder="文字中心点位置" v-model="text_x">
                <input type="text" id="text" class="text_y" placeholder="文字中心点位置" v-model="text_y">
            </div>
        </form>
    </div>

    <div class="col-12 col-sm-12 col-md-6">
        <button @click="d">
            asd
        </button>
    </div>
@endsection

@section('js')
    <script>
        new Vue({
            el: '#app',
            mounted: function () {
                this.drawc();
            },
            data: {
                text: 'f',
                backgroundColor: '#3b5998',
                font_size: 200,
                font_family: 'Verdana',
                textColor: '#ffffff',
                text_x: 150,
                text_y: 150 ,
            },
            methods: {
                drawc: function () {
                    c = draw;
                    ctx = draw.getContext("2d");

                    ctx.fillStyle = this.backgroundColor;
                    ctx.fillRect(0, 0, 300, 300);

                    ctx.fillStyle = this.textColor;
                    ctx.font = this.font_size + "px " + this.font_family;

                    ctx.textAlign = "center";
                    ctx.fillText(this.text, this.text_x, this.text_y);
                },
                d: function () {
                    // var $form = $('<form method="GET"></form>');
                    // $form.attr('action', draw.toDataURL("image/png"));
                    // $form.appendTo($('body'));
                    // $form.submit();
                    // c = draw;
                    // url = c.toDataURL("image/png");
                    // download.style.display = "block";
                    //
                    // var myDate = new Date();
                    // //图片名
                    // var fileName = myDate.toLocaleTimeString();
                    // download.onclick = function () {
                    //     download.setAttribute('href', url);
                    //     download.setAttribute('download', fileName);
                    // }
                }
            },
            watch: {
                text:function () {
                    this.drawc();
                },
                backgroundColor:function () {
                    this.drawc();
                },
                font_size:function () {
                    this.drawc();
                },
                font_family:function () {
                    this.drawc();
                },
                textColor:function () {
                    this.drawc();
                },
                text_x:function () {
                    this.drawc();
                },
                text_y:function () {
                    this.drawc();
                },
            }
        });
    </script>
@endsection