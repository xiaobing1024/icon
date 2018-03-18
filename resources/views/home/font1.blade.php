@extends('layouts.app')

@section('css')
    <style>
        /*.btn-success {*/
            /*margin-top: 30px;*/
        /*}*/

        /*.btn-primary {*/
            /*margin-top: 30px;*/
            /*font-family: "Adobe Arabic";*/
        /*}*/
    </style>
@endsection

@section('content')
    {{--<blockquote style="background: snow;margin-bottom: 50px">--}}
    {{--<p>To make life more beautiful, please use the art icon</p>--}}
    {{--<footer>Someone famous in <cite title="Source Title">bingoicon</cite></footer>--}}
    {{--</blockquote>--}}
    <div class="container" style="display:table;height:100%;">
        <div class="row" style="display: table-cell;position: relative; border: 1px solid#dddddd;
   vertical-align: middle;width: 800px;height: 400px;text-align: center">
            <div class="container  " style="position: absolute;left: 0;top: 0;width: 100%;height: 50px;line-height: 50px;background: #f5f5f5;
    border-bottom: 1px solid#dddddd;
">
                <span style="float: left;color: #5e5e5e;font-size: 20px;">控制输入台</span>
            </div>
            <form class="form-inline" action="#" style="margin-top: 20px">
                <textarea class="form-control" rows="3" id="demo"
                          style="width: 720px;height: 250px;display: table-cell;"
                          placeholder="选好字体，背景色，点击提交即可生成">美团</textarea>
                <div class="form-group" style="margin-top: 10px">
                    <select class="selectpicker form-control" id="family" style="width: 120px">
                        @foreach($font as $v)
                            <option {{ $loop->first ? 'selected' : '' }} style="font-family: {{$v->font_family}}">{{$v->font}}</option>
                        @endforeach
                    </select>
                    <label for="exampleInputName2">字体颜色</label>
                    <input type="text" value="#ffffff" class="form-control" id="color" placeholder="字体颜色" style="width:120px">
                    <label for="exampleInputName2">字体大小</label>
                    <input type="text" value="20" class="form-control" id="sssss" placeholder="字体大小" style="width:120px">
                    <label for="exampleInputName2">背景色</label>
                    <input type="text" value="#06c1b0" class="form-control " id="background" placeholder="背景色" style="width: 120px">
                    <input type="submit" class="form-control" id="submit" value="提交"
                           style="background:#2ab27b;color: #dddddd">
                </div>
            </form>
        </div>
    </div>
    <div id="div1" style="margin:20px auto 0;width:50px;
    height:50px;">
        <canvas id="drawing" style="display: none;" width="50px" height="50px">A Drawing of something</canvas>
        <canvas id="canvas" style="display: none;" width="1024px" height="1024px">A Drawing of something</canvas>
        <a download="" class="btn btn-info"
           style="width:50px;display:none;cursor: pointer;margin:20px auto 0;margin-right: 10px" id="download">下载</a>
    </div>

@endsection

@section('js')
    <script>
        window.onload = function () {
            var button = document.getElementById('submit');
            //记录点击
            var index = 0;
            //select
            var select = document.getElementById('family');
            select.onchange = function () {
                var index = select.selectedIndex; // 选中索引
                var text = select.options[index].style.fontFamily; // 选中文字样式
                select.style.fontFamily = text;
            }
            button.onclick = function () {
                event.preventDefault();
                index++;
                var drawing = document.getElementById("drawing");
                var canvas = document.getElementById("canvas");
                var download = document.getElementById("download");
                var div = document.getElementById('div1');
                var myDate = new Date();
                //图片名
                var fileName = myDate.toLocaleTimeString();
                if (drawing.getContext) {
                    //取得绘图上下文对象的引用，“2d”是取得2D上下文对象
                    var context = drawing.getContext("2d");
                    var background = document.getElementById('background').value;
                    var sizes = document.getElementById('sssss').value;
                    var family = document.getElementById('family').value;
                    var color = document.getElementById('color').value;
                    var demo = document.getElementById('demo').value;
                    if (index > 1) {
                        //防止重复
                        div.removeChild(div.childNodes[0]);
                    }
                    context.fillStyle = background;
                    context.fillRect(0, 0, 50, 50);
                    context.font = sizes + 'px ' + family;
                    context.fillStyle = color;
                    context.textAlign = "center";
                    context.fillText(demo, 25, 25 + sizes / 3, 100);
                    //制作边框
                    context.lineWidth = 3;
                    context.moveTo(0, 0);
                    context.lineTo(50, 0);
                    context.lineTo(50, 50);
                    context.lineTo(0, 50);
                    context.lineTo(0, 0);
                    context.closePath();//闭合路径
                    context.strokeStyle = '#dddddd';
                    context.stroke();
                    //取得图像的数据URI
                    var imgURI = drawing.toDataURL("image/png");
                    //显示图像
                    var image = document.createElement("img");
                    image.src = imgURI;
                    div.insertBefore(image, drawing);
                    var con = canvas.getContext("2d");
                    con.fillStyle = background;
                    con.fillRect(0, 0, 1024, 1024);
                    con.font = 1024 / 50 * sizes + 'px ' + family;
                    con.fillStyle = color;
                    con.textAlign = "center";
                    con.fillText(demo, 512, 512 + 1024 / 50 * sizes / 3, 1024 / 50 * 100);
                    con.lineWidth = 3;
                    con.moveTo(0, 0);
                    con.lineTo(1024, 0);
                    con.lineTo(1024, 1024);
                    con.lineTo(0, 1024);
                    con.lineTo(0, 0);
                    con.closePath();//闭合路径
                    con.strokeStyle = '#dddddd';
                    con.stroke();
                    //取得图像的数据URI
                    var imgURI1 = canvas.toDataURL("image1/png");
                    //显示图像
                    var image1 = document.createElement("img");
                    image1.src = imgURI1;
                    if (image1) {
                        download.style.display = "block";
                        download.onclick = function () {
                            download.setAttribute('href', imgURI1);
                            download.setAttribute('download', fileName);
                        }
                    }
                } else {
                    if (image1) {
                        download.style.display = "block";
                        download.onclick = function () {
                            download.setAttribute('href', imgURI1);
                            download.setAttribute('download', fileName);
                        }
                    }
                }

            }
        }
    </script>
@endsection