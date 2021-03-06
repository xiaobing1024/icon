@extends('layouts.app')

@section('css')
    <style>
        [v-cloak] {
            display: none !important;
        }
    </style>
@endsection

@section('meta')
<meta name="keywords" content="文字图标制作,图标在线制作,图标在线预览">
<meta name="description" content="在线预览生成图片,输入文字,字体,大小等等即可下载图片">
@endsection

@section('title')
<title>BingoIcon-在线制作图标_文字图标在线生成</title>
@endsection
@section('content')
<h1 class="text-hide">文字图标</h1>
    <div class="col-12 col-sm-12 col-md-6 form-group">
        <div class="text-center" width="256" height="256">
            <canvas id="draw" width="256" height="256" data-toggle="tooltip" title="预览图片大小为 256*256 下载图片大小为 1024*1024"
                    style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 30px, rgba(0, 0, 0, 0.23) 0px 6px 10px; background:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQAQMAAAAlPW0iAAAABlBMVEX////MzMw46qqDAAAAD0lEQVQI12P4z4Ad4ZAAAH6/D/Hgw85/AAAAAElFTkSuQmCC') top left repeat"></canvas>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6">
        <form>
            <div class="form-group row">
                <label for="backgroundColor" class="col-xl-2 col-form-label">
                    <a href="http://www.sioe.cn/yingyong/yanse-rgb-16/" data-toggle="tooltip" data-placement="right"
                       title="点击查看提示"
                       target="_Blank">背景色</a>
                </label>
                <div class="col-xl-4">
                    <input type="text" data-toggle="tooltip"
                           title="可以再增加两位数字设置透明度 00 为透明背景 一些浏览器暂不支持或使用 rgba(0,0,0,0.0)" id="backgroundColor"
                           class="form-control" placeholder="可以再增加两位数字设置透明度"
                           v-model="backgroundColor">
                </div>

                <label for="textColor" class="col-xl-2 col-form-label">
                    <a href="http://www.colorhunt.co/" data-toggle="tooltip" data-placement="right" title="点击查看提示"
                       target="_Blank">文字颜色</a>
                </label>
                <div class="col-xl-4">
                    <input type="text" data-toggle="tooltip" title="留空则透明" id="textColor" class="form-control"
                           placeholder="文字颜色" v-model="textColor">
                </div>
            </div>

            <div class="form-group row">
                <label for="text" class="col-xl-2 col-form-label">文字</label>
                <div class="col-xl-4">
                    <input type="text" id="text" class="form-control" placeholder="图标中的文字" v-model="text">
                </div>

                <label for="font_family" class="col-xl-2 col-form-label">字体</label>
                <div class="col-xl-4">
                    <select name="font_family" id="font_family" class="form-control" v-model="font_family" v-cloak>
                        <option v-bind:value="f.font_family" :style="f" v-for="f in fonts">@{{ f.font }}</option>
                    </select>
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
                </div>
            </div>

            <div class="form-group row">
                <label for="text_x" class="col-xl-2 col-form-label">左右</label>
                <div class="col-xl-4">
                    <input type="number" data-toggle="tooltip" title="128为居中" id="text_x" class="form-control"
                           placeholder="128居中" v-model="text_x">
                </div>

                <label for="text_y" class="col-xl-2 col-form-label">上下</label>
                <div class="col-xl-4">
                    <input type="number" data-toggle="tooltip" title="128为居中" id="text_y" class="form-control"
                           placeholder="128居中" v-model="text_y">
                </div>
            </div>

            <div class="form-group row">
                <label for="shadow-color" class="col-xl-2 col-form-label">阴影颜色</label>
                <div class="col-xl-4">
                    <input type="text" data-toggle="tooltip" title="不支持背景与阴影透明度混合.如果不知道填什么好,鄙人瞎算法：背景色的左数第1,3,5位数字至少减去3"
                           id="shadow-color" class="form-control"
                           placeholder="可以参照默认的背景色和阴影颜色" v-model="shadowColor">
                </div>

                <label for="shadow-angle" class="col-xl-2 col-form-label">阴影角度</label>
                <div class="col-xl-4">
                    <input type="number" data-toggle="tooltip" title="范围 0 ~ 360 注意有些角度会导致线条不直" id="shadow-angle"
                           class="form-control"
                           placeholder="范围 0 ~ 360" v-model="shadowAngle">
                </div>
            </div>

            <div class="form-group row">
                <label for="shadow-length" class="col-xl-2 col-form-label">阴影长度</label>
                <div class="col-xl-4">
                    <input type="number" data-toggle="tooltip" title="0 则无阴影" id="shadow-length" class="form-control"
                           placeholder="0 则无阴影" v-model="shadowLength">
                </div>

                <label for="font_style" class="col-xl-2 col-form-label">字体样式</label>
                <div class="col-xl-4">
                    <select name="font_style" id="font_style" class="form-control" v-model="font_style">
                        <option value="normal">normal</option>
                        <option value="italic">italic</option>
                        <option value="oblique">oblique</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <a class="btn btn-block btn-outline-success btn-lg" id="go" @click="downloadclick" href="#">
                        <i class="fa fa-picture-o"></i> 下载图片
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="col-12 mb-3 form-inline">
        <button class="btn btn-sm btn-outline-success mr-3" type="button" @click="addText"><i class="fa fa-plus"></i>
            增加文字
        </button>
        <a class="btn btn-sm btn-outline-primary mr-3" href="https://tinypng.com/" target="_blank"><i
                    class="fa fa-bolt"></i>
            图片压缩</a>

        <input type="text" data-toggle="tooltip" title="请填写字体链接地址，字体名字中有空格则用 + 号代替" id="g-font-url"
               class="col-sm-12 col-md-3 col-xl-3 form-control mr-3"
               placeholder="例子：https://fonts.googleapis.com/css?family=Dancing+Script"
               value="https://fonts.googleapis.com/css?family=Dancing+Script">
        <input type="text" data-toggle="tooltip" title="请填写字体英文名，一些字体没有支持所有的粗细和样式，需将文字设置成支持的粗细和样式才有效果" id="g-font-name"
               class="col-sm-6 col-md-2 col-xl-2 form-control mr-3"
               placeholder="例子：Dancing Script" value="Dancing Script">
        <button class="btn btn-sm btn-outline-danger mr-3" data-toggle="tooltip" title="如果字体加载完成后无效果，请在上面重新选择其他字体，再选回来"
                type="button" @click="addFont">
            <i class="fa fa-font"></i> 加载新字体
        </button>
        <a href="http://www.googlefonts.cn/" data-toggle="tooltip" data-placement="right"
           title="点击查看提示"
           target="_Blank">字体名？</a>
    </div>

    <div class="col-12 mb-3" v-for="(v, vi) in texts" v-cloak>
        <div class="form-row mb-3">
            <label class="col-xl-1 col-form-label">
                <a href="http://www.colorhunt.co/" data-toggle="tooltip" data-placement="right" title="点击查看提示"
                   target="_Blank">文字颜色</a>
            </label>
            <div class="col-xl-2">
                <input type="text" data-toggle="tooltip" title="留空则透明" class="form-control" placeholder="文字颜色"
                       v-model="v.textColor">
            </div>

            <label class="col-xl-1 col-form-label">文字</label>
            <div class="col-xl-2">
                <input type="text" class="form-control" placeholder="图标中的文字" v-model="v.text">
            </div>

            <label class="col-xl-1 col-form-label">字体</label>
            <div class="col-xl-2">
                <select name="font_family" class="form-control" v-model="v.font_family">
                    <option v-bind:value="f.font_family" :style="f" v-for="f in fonts">@{{ f.font }}</option>
                </select>
            </div>

            <label class="col-xl-1 col-form-label">字体大小</label>
            <div class="col-xl-2">
                <input type="number" class="form-control" placeholder="字体大小 单位px"
                       v-model="v.font_size">
            </div>
        </div>
        <div class="form-row mb-3">
            <label class="col-xl-1 col-form-label">字体粗细</label>
            <div class="col-xl-2">
                <select name="font_weight" class="form-control" v-model="v.font_weight">
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
            </div>

            <label class="col-xl-1 col-form-label">左右</label>
            <div class="col-xl-2">
                <input type="number" data-toggle="tooltip" title="128为居中" class="form-control" placeholder="128居中"
                       v-model="v.text_x">
            </div>

            <label class="col-xl-1 col-form-label">上下</label>
            <div class="col-xl-2">
                <input type="number" data-toggle="tooltip" title="128为居中" class="form-control" placeholder="128居中"
                       v-model="v.text_y">
            </div>

            <label class="col-xl-1 col-form-label">字体样式</label>
            <div class="col-xl-2">
                <select name="font_style" class="form-control" v-model="v.font_style">
                    <option value="normal">normal</option>
                    <option value="italic">italic</option>
                    <option value="oblique">oblique</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <label class="col-xl-1 col-form-label">阴影颜色</label>
            <div class="col-xl-2">
                <input type="text" data-toggle="tooltip" title="不支持背景与阴影透明度混合.如果不知道填什么好,鄙人瞎算法：背景色的左数第1,3,5位数字至少减去3"
                       class="form-control"
                       placeholder="可以参照默认的背景色和阴影颜色" v-model="v.shadowColor">
            </div>

            <label class="col-xl-1 col-form-label">阴影角度</label>
            <div class="col-xl-2">
                <input type="number" data-toggle="tooltip" title="范围 0 ~ 360 注意有些角度会导致线条不直" class="form-control"
                       placeholder="范围 0 ~ 360" v-model="v.shadowAngle">
            </div>

            <label class="col-xl-1 col-form-label">阴影长度</label>
            <div class="col-xl-2">
                <input type="number" data-toggle="tooltip" title="0 则无阴影" class="form-control"
                       placeholder="0 则无阴影" v-model="v.shadowLength">
            </div>

            <button class="offset-xl-1 col-xl-2 btn btn-outline-danger" @click="deleteText(vi)">
                <i class="fa fa-times"></i> 关闭
            </button>
        </div>
    </div>

    <div class="text-center" width="1024" height="1024" style="display: none; background:rgba(255,255,255,0);">
        <canvas id="drawcopy" width="1024" height="1024" style="background:rgba(255,255,255,0);"></canvas>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
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
                font_style: 'normal',
                font_family: 'Verdana',
                font_weight: 'normal',
                textColor: '#ffffff',
                text_x: 148,
                text_y: 160,
                texts: [],
                shadowColor: '#0b2968',
                shadowAngle: 45,
                shadowLength: '300',
                fonts: {!! json_encode($font) !!}
            },
            methods: {
                drawc: function () {
                    ctx = draw.getContext("2d");
                    ctx.clearRect(0, 0, 256, 256);
                    ctx.fillStyle = this.backgroundColor;
                    ctx.fillRect(0, 0, 256, 256);

                    ctx.font = this.font_style + " " + this.font_weight + " " + this.font_size + "px " + this.font_family;
                    ctx.textBaseline = "middle";
                    ctx.textAlign = "center";

                    if (this.shadowLength.length > 0 && this.shadowLength !== '0') {
                        ctx.globalCompositeOperation = "source-atop";
                        c = parseInt(this.shadowAngle) * Math.PI / 180;
                        rx = Math.cos(c);
                        ry = Math.sin(c);
                        ctx.fillStyle = this.shadowColor;
                        for (i = parseInt(this.shadowLength), j = 0; i > j; i -= 1) {
                            x = Math.floor(i * rx);
                            y = Math.floor(i * ry);
                            ctx.fillText(this.text, parseInt(this.text_x) + x, parseInt(this.text_y) + y);
                        }
                        ctx.globalCompositeOperation = "source-over";
                    }

                    if (this.textColor.length < 1) {
                        ctx.globalCompositeOperation = "destination-out";
                    } else {
                        ctx.fillStyle = this.textColor;
                    }
                    ctx.fillText(this.text, this.text_x, this.text_y);
                    if (this.textColor.length < 1) {
                        ctx.globalCompositeOperation = "source-over";
                    }

                    for (i = 0, j = this.texts.length; i < j; i++) {
                        obj = this.texts[i];

                        ctx.font = obj.font_style + " " + obj.font_weight + " " + obj.font_size + "px " + obj.font_family;
                        ctx.textBaseline = "middle";
                        ctx.textAlign = "center";

                        if (obj.shadowLength.length > 0 && obj.shadowLength !== '0') {
                            ctx.globalCompositeOperation = "source-atop";
                            c = obj.shadowAngle * Math.PI / 180;
                            rx = Math.cos(c);
                            ry = Math.sin(c);
                            ctx.fillStyle = obj.shadowColor;
                            for (si = obj.shadowLength, sj = 0; si > sj; si -= 1) {
                                x = Math.round(si * rx);
                                y = Math.round(si * ry);
                                ctx.fillText(obj.text, parseInt(obj.text_x) + x, parseInt(obj.text_y) + y);
                            }
                            ctx.globalCompositeOperation = "source-over";
                        }

                        if (obj.textColor.length < 1) {
                            ctx.globalCompositeOperation = "destination-out";
                        } else {
                            ctx.fillStyle = obj.textColor;
                        }
                        ctx.fillText(obj.text, obj.text_x, obj.text_y);
                        if (obj.textColor.length < 1) {
                            ctx.globalCompositeOperation = "source-over";
                        }
                    }
                },
                downloadclick() {
                    ctxcopy = drawcopy.getContext("2d");
                    ctxcopy.clearRect(0, 0, 1024, 1024);
                    ctxcopy.fillStyle = this.backgroundColor;
                    ctxcopy.fillRect(0, 0, 1024, 1024);

                    ctxcopy.font = this.font_style + " " + this.font_weight + " " + (this.font_size * 4) + "px " + this.font_family;
                    ctxcopy.textBaseline = "middle";
                    ctxcopy.textAlign = "center";

                    if (this.shadowLength.length > 0 && this.shadowLength !== '0') {
                        ctxcopy.globalCompositeOperation = "source-atop";
                        c = parseInt(this.shadowAngle) * Math.PI / 180;
                        rx = Math.cos(c);
                        ry = Math.sin(c);
                        ctxcopy.fillStyle = this.shadowColor;
                        for (i = this.shadowLength * 4, j = 0; i > j; i -= 1) {
                            x = Math.round(i * rx);
                            y = Math.round(i * ry);
                            ctxcopy.fillText(this.text, parseInt(this.text_x) * 4 + x, parseInt(this.text_y) * 4 + y);
                        }
                        ctxcopy.globalCompositeOperation = "source-over";
                    }

                    if (this.textColor.length < 1) {
                        ctxcopy.globalCompositeOperation = "destination-out";
                    } else {
                        ctxcopy.fillStyle = this.textColor;
                    }
                    ctxcopy.fillText(this.text, this.text_x * 4, this.text_y * 4);
                    if (this.textColor.length < 1) {
                        ctxcopy.globalCompositeOperation = "source-over";
                    }

                    for (i = 0, j = this.texts.length; i < j; i++) {
                        obj = this.texts[i];

                        ctxcopy.font = obj.font_style + " " + obj.font_weight + " " + (obj.font_size * 4) + "px " + obj.font_family;
                        ctxcopy.textBaseline = "middle";
                        ctxcopy.textAlign = "center";

                        if (obj.shadowLength.length > 0 && obj.shadowLength !== '0') {
                            ctxcopy.globalCompositeOperation = "source-atop";
                            c = obj.shadowAngle * Math.PI / 180;
                            rx = Math.cos(c);
                            ry = Math.sin(c);
                            ctxcopy.fillStyle = obj.shadowColor;
                            for (si = obj.shadowLength * 4, sj = 0; si > sj; si -= 1) {
                                x = Math.round(si * rx);
                                y = Math.round(si * ry);
                                ctxcopy.fillText(obj.text, parseInt(obj.text_x) * 4 + x, parseInt(obj.text_y) * 4 + y);
                            }
                            ctxcopy.globalCompositeOperation = "source-over";
                        }

                        if (obj.textColor.length < 1) {
                            ctxcopy.globalCompositeOperation = "destination-out";
                        } else {
                            ctxcopy.fillStyle = obj.textColor;
                        }
                        ctxcopy.fillText(obj.text, obj.text_x * 4, obj.text_y * 4);
                        if (obj.textColor.length < 1) {
                            ctxcopy.globalCompositeOperation = "source-over";
                        }
                    }

                    go.href = drawcopy.toDataURL("image/png");
                    go.download = "icon.png";
                },
                addText() {
                    this.texts.push({
                        text: this.text ? this.text : 'f',
                        font_style: this.font_style ? this.font_style : 'normal',
                        font_size: this.font_size ? this.font_size : 300,
                        font_family: this.font_family ? this.font_family : 'Verdana',
                        font_weight: this.font_weight ? this.font_weight : 'normal',
                        textColor: this.textColor ? this.textColor : '#ffffff',
                        text_x: parseInt(this.text_x) + (this.texts.length + 1) * 10,
                        text_y: parseInt(this.text_y) + (this.texts.length + 1) * 10,
                        shadowColor: this.shadowColor ? this.shadowColor : '#000000',
                        shadowAngle: this.shadowAngle ? this.shadowAngle : '45',
                        shadowLength: this.shadowLength ? this.shadowLength : '300',
                    })
                },
                addFont() {
                    furl = document.getElementById('g-font-url').value;
                    fname = document.getElementById('g-font-name').value;
                    if (furl.length < 1) {
                        $('#g-font-url').tooltip('show');
                        return;
                    }
                    if (fname.length < 1) {
                        $('#g-font-name').tooltip('show');
                        return;
                    }

                    node = document.createElement("link");
                    node.setAttribute("rel", "stylesheet");
                    node.setAttribute("type", "text/css");
                    node.setAttribute("href", furl);
                    document.head.appendChild(node);

                    $('body').append("<p style=\"position: absolute;left: -9999px;font-family: '" + fname + "'\">xxx</p>");
                    self = this;
                    this.styleOnload(node, function () {
                        self.fonts.unshift({
                            font: fname,
                            font_family: fname
                        });
                        setTimeout(function () {
                            self.font_family = fname;
                        }, 1000);
                    });

                },
                deleteText(idx) {
                    this.texts.splice(idx, 1);
                },
                styleOnload(node, callback) {
                    if (node.attachEvent) {
                        node.attachEvent('onload', callback);
                    }
                    else {
                        setTimeout(function () {
                            poll(node, callback);
                        }, 0);
                    }
                },
            },
            watch: {
                text: function () {
                    this.drawc();
                },
                backgroundColor: function () {
                    this.drawc();
                },
                font_style: function () {
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
                shadowColor: function () {
                    this.drawc();
                },
                shadowAngle: function () {
                    this.drawc();
                },
                shadowLength: function () {
                    this.drawc();
                },
                texts: {
                    handler: function (val, oldVal) {
                        this.drawc();
                    },
                    deep: true
                },
            }
        });

        function poll(node, callback) {
            if (callback.isCalled) {
                return;
            }
            isLoaded = false;

            if (/webkit/i.test(navigator.userAgent)) {
                if (node['sheet']) {
                    isLoaded = true;
                }
            } else if (node['sheet']) {
                try {
                    if (node['sheet'].cssRules) {
                        isLoaded = true;
                    }
                } catch (ex) {
                    if (ex.code === 1000) {
                        isLoaded = true;
                    }
                }
            }

            if (isLoaded) {
                setTimeout(function () {
                    callback();
                }, 1);
            }
            else {
                setTimeout(function () {
                    poll(node, callback);
                }, 1);
            }
        }
    </script>
@endsection
