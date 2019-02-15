@extends('mobile.layouts.app')

@section('css')
    <link href="https://cdn.bootcss.com/Swiper/4.4.6/css/swiper.min.css" rel="stylesheet">
    <style>
        .swiper-container {
            height: 30px;  /*设置整个跑马灯高度*/
        }
        .swiper-container span{
            height: 100%;  /*与跑马灯高度保持一致*/
            width: 100%;   /*防止尺寸变小时图片重叠*/
        }
        .kind-list__item {
            margin: 20px 0;
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
            color: #fff;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.23), 0 3px 12px rgba(0, 0, 0, 0.16);
        }

        .kind-list__item-hd {
            padding: 10px 20px;
            -webkit-transition: opacity 0.3s;
            transition: opacity 0.3s;
        }

        .index-title {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            color: #fff
        }

        .index-subtitle {
            font-size: 12px;
            color: #fff;
        }

        .weui-cell_access .weui-cell__ft:after {
            content: "";
            border-color: #fff;
        }

        #today {
            background-image: linear-gradient(135deg, #ea5455 10%, #feb692 100%);
        }

        #ssq {
            background-image: linear-gradient(135deg, #fa742b 10%, #ffe985 100%);
        }

        #dlt {
            background-image: linear-gradient(135deg, #28c76f 10%, #81fbb8 100%);
        }

        #mnxh {
            background-image: linear-gradient(135deg, #0396ff 10%, #abdcff 100%);
        }

        #zxsj {
            background-image: linear-gradient(135deg, #9f44d3 10%, #e2b0ff 100%);
        }

        #xyc {
            background-image: linear-gradient(135deg, #4e54c8 10%, #8f94fb 100%);
        }

        .index-content {
            font-size: 15px;
            color: #fff
        }
    </style>
@endsection

@section('content')
    <div class="page" style="padding-left:15px;padding-right:15px;padding-bottom:30px;">
        <div class="page__bd page__bd_spacing">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($msg as $m)
                        <span class="swiper-slide" style="font-size: 16px;white-space: nowrap">{{ $m->name.' : '.$m->msg }}</span>
                    @endforeach
                </div>
            </div>
            {{--<marquee>--}}
            {{--@foreach($msg as $m)--}}
                {{--<span style="font-size: 16px;margin-right: 150px">{{ $m->name.' : '.$m->msg }}</span>--}}
            {{--@endforeach--}}
            {{--</marquee>--}}
            <ul class="kind-list">
                <li class="kind-list__item" style="margin:0">
                    <div id="today" class="weui-flex kind-list__item-hd weui-cell weui-cell_access">
                        <div class="weui-flex__item">
                            <div class="index-title">
                                <span>{{ now()->format('Y-m-d') . ' 星期' . ['日', '一', '二', '三', '四', '五', '六'][date('w')] }}</span>
                                <span class="index-subtitle">随缘一注</span>
                            </div>
                            <div class="weui-flex" style="margin-top: 5px;" v-cloak>
                                <div class="ball">
                                    @{{ random[0] }}
                                </div>
                                <div class="ball">
                                    @{{ random[1] }}
                                </div>
                                <div class="ball">
                                    @{{ random[2] }}
                                </div>
                                <div class="ball">
                                    @{{ random[3] }}
                                </div>
                                <div class="ball">
                                    @{{ random[4] }}
                                </div>
                                <div class="ball" v-bind:class="{ 'blue-ball': type==1 }">
                                    @{{ random[5] }}
                                </div>
                                <div class="ball blue-ball">
                                    @{{ random[6] }}
                                </div>
                            </div>
                            <div class="weui-flex" style="align-items:baseline">
                                <button class="weui-btn weui-btn_mini weui-btn_primary"
                                        style="margin-left:0;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);height: 29px"
                                        v-on:click.self="index_random_type">切换
                                </button>
                                <button id="copy" class="weui-btn weui-btn_mini weui-btn_default"
                                        style="box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);"
                                        v-bind:data-clipboard-text="copyText">复制
                                </button>
                                <button class="weui-btn weui-btn_mini weui-btn_warn"
                                        style="margin-right:0;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);"
                                        v-on:click.self="index_random">换一注
                                </button>
                            </div>
                        </div>
                        <div class="weui-cell__ft"></div>
                    </div>
                </li>

                <li class="kind-list__item">
                    <a href="{{ url('cp/ssq') }}">
                        <div id="ssq" class="weui-flex kind-list__item-hd weui-cell weui-cell_access">
                            <div class="weui-flex__item">
                                <div class="index-title">
                                    <span>双色球</span>
                                    <span class="index-subtitle">{{ $ssq[1] }}</span>
                                </div>
                                <div class="weui-flex" style="margin-top: 5px;">
                                    <div class="ball">
                                        {{ $ssq[0][0] }}
                                    </div>
                                    <div class="ball">
                                        {{ $ssq[0][1] }}
                                    </div>
                                    <div class="ball">
                                        {{ $ssq[0][2] }}
                                    </div>
                                    <div class="ball">
                                        {{ $ssq[0][3] }}
                                    </div>
                                    <div class="ball">
                                        {{ $ssq[0][4] }}
                                    </div>
                                    <div class="ball">
                                        {{ $ssq[0][5] }}
                                    </div>
                                    <div class="ball blue-ball">
                                        {{ $ssq[0][6] }}
                                    </div>
                                </div>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </div>
                    </a>
                </li>

                <li class="kind-list__item">
                    <a href="{{ url('cp/dlt') }}">
                        <div id="dlt" class="weui-flex kind-list__item-hd weui-cell weui-cell_access">
                            <div class="weui-flex__item">
                                <div class="index-title">
                                    <span>大乐透</span>
                                    <span class="index-subtitle">{{ $dlt[1] }}</span>
                                </div>
                                <div class="weui-flex" style="margin-top: 5px;">
                                    <div class="ball">
                                        {{ $dlt[0][0] }}
                                    </div>
                                    <div class="ball">
                                        {{ $dlt[0][1] }}
                                    </div>
                                    <div class="ball">
                                        {{ $dlt[0][2] }}
                                    </div>
                                    <div class="ball">
                                        {{ $dlt[0][3] }}
                                    </div>
                                    <div class="ball">
                                        {{ $dlt[0][4] }}
                                    </div>
                                    <div class="ball blue-ball">
                                        {{ $dlt[0][5] }}
                                    </div>
                                    <div class="ball blue-ball">
                                        {{ $dlt[0][6] }}
                                    </div>
                                </div>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </div>
                    </a>
                </li>

                <li class="kind-list__item">
                    <a href="{{ url('cp/mnxh') }}">
                        <div id="mnxh" class="weui-flex kind-list__item-hd weui-cell weui-cell_access">
                            <div class="weui-flex__item">
                                <div class="index-title">
                                    <span>模拟选号</span>
                                </div>
                                <div class="index-content">计算购买成本 查看所选号码的历史开奖情况</div>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </div>
                    </a>
                </li>

                <li class="kind-list__item">
                    <a href="{{ url('cp/zxsj') }}">
                        <div id="zxsj" class="weui-flex kind-list__item-hd weui-cell weui-cell_access">
                            <div class="weui-flex__item">
                                <div class="index-title">
                                    <span>自选随机</span>
                                </div>
                                <div class="index-content">自定义随机范围 查看所选号码的历史开奖情况</div>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </div>
                    </a>
                </li>

                <li class="kind-list__item">
                    <a href="{{ url('cp/xyc') }}">
                        <div id="xyc" class="weui-flex kind-list__item-hd weui-cell weui-cell_access">
                            <div class="weui-flex__item">
                                <div class="index-title">
                                    <span>许愿池</span>
                                </div>
                                <div class="index-content">得偿所愿🙏一次就好</div>
                            </div>
                            <div class="weui-cell__ft"></div>
                        </div>
                    </a>
                </li>
            </ul>

        </div>
    </div>
@endsection

@section('js')
    <script>
        function formatTime(date, fmt) {
            var o = {
                "M+": date.getMonth() + 1, //月份
                "d+": date.getDate(), //日
                "h+": date.getHours() % 12 === 0 ? 12 : date.getHours() % 12, //小时
                "H+": date.getHours(), //小时
                "m+": date.getMinutes(), //分
                "s+": date.getSeconds(), //秒
                "q+": Math.floor((date.getMonth() + 3) / 3), //季度
                "S": date.getMilliseconds() //毫秒
            };
            var week = {
                "0": "\u65e5",
                "1": "\u4e00",
                "2": "\u4e8c",
                "3": "\u4e09",
                "4": "\u56db",
                "5": "\u4e94",
                "6": "\u516d"
            };
            if (/(y+)/.test(fmt)) {
                fmt = fmt.replace(RegExp.$1, (date.getFullYear() + "").substr(4 - RegExp.$1.length));
            }
            if (/(E+)/.test(fmt)) {
                fmt = fmt.replace(RegExp.$1, ((RegExp.$1.length > 1) ? (RegExp.$1.length > 2 ? "\u661f\u671f" : "\u5468") : "") + week[date.getDay() + ""]);
            }
            for (var k in o) {
                if (new RegExp("(" + k + ")").test(fmt)) {
                    fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
                }
            }
            return fmt;
        }

        $(function () {
            var clipboard = new ClipboardJS('#copy');
            clipboard.on('success', function (e) {
                $.toast("复制成功");
            });

            clipboard.on('error', function (e) {
                $.toast("复制失败", "cancel");
            });
        });

        new Vue({
            el: '.page',
            data: {
                today: formatTime(new Date(), 'yyyy-MM-dd EEE'),
                random: random_num(),
                type: 0,
            },
            methods: {
                index_random() {
                    this.random = random_num(this.type);
                },
                index_random_type() {
                    this.type = this.type === 0 ? 1 : 0;
                    this.random = random_num(this.type);
                },
            },
            computed: {
                copyText: function () {
                    return this.random.slice(0, this.type === 0 ? 6 : 5).join(' ') + ' + ' + this.random.slice(this.type === 0 ? 6 : 5, 7).join(' ');
                }
            }
        });
    </script>

    <script src="https://cdn.bootcss.com/Swiper/4.4.6/js/swiper.min.js"></script>
    <script>
        var mySwiper = new Swiper ('.swiper-container', {
            loop: true,    //设置循环滚动
            // 如果需要前进后退按钮
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            speed:10000,  //设置图片滚动速度

            // 自动滚动，注意与上面的loop不一样，loop是指能否从最后位置滚动回第一的位置
            autoplay:{
                delay:1,   //每滚动一个图片后等待的时间，这里设置为1ms就是代表没有等待
                //触摸后不会停止自动滚动
                disableOnInteraction:false,
            },


            //同时显示多少个图片
            slidesPerView: 1,
            loop : true,
            spaceBetween: 200,   //两图片之间的空隙
            breakpoints: {   //设置浏览器不同尺寸时的显示方式
                320: {
                    slidesPerView: 1,
                    spaceBetween: 200
                },
                //当宽度小于等于640
                640: {
                    slidesPerView: 1,
                    spaceBetween: 200
                }
            },

        });
        //因为这里需要用到mouseover事件，所以前面要引入jQuery库
        $('.swiper-container').mouseover(function(){
            mySwiper.autoplay.stop();   //鼠标悬停在跑马灯上时停止滚动
        });
        $('.swiper-container').mouseout(function(){
            mySwiper.autoplay.start();
        });
        //swiper中设置了图片的滚动动画是ease-out，需要改成linear才有平稳滚动的效果
        mySwiper.$wrapperEl.css({'-webkit-transition-timing-function': "linear","-moz-transition-timing-function": "linear","-ms-transition-timing-function": "linear","-o-transition-timing-function": "linear","transition-timing-function": "linear"});

    </script>
@endsection

