@extends('mobile.layouts.app')

@section('css')
    <style>
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

        .index-content {
            font-size: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="page" style="padding: 0 15px">
        <div class="page__bd page__bd_spacing">

            <ul class="kind-list">
                <li class="kind-list__item">
                    <div id="today" class="weui-flex kind-list__item-hd weui-cell weui-cell_access" v-bind:data-clipboard-text="copyText">
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
                                        style="margin-left:0;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);height: 29px" v-on:click.self="index_random_type">切换</button>
                                <button id="copy" class="weui-btn weui-btn_mini weui-btn_default"
                                        style="box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);" v-bind:data-clipboard-text="copyText">复制</button>
                                <button class="weui-btn weui-btn_mini weui-btn_warn"
                                        style="margin-right:0;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);" v-on:click.self="index_random">换一注</button>
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
                                <div class="ball">
                                    {{ $dlt[0][5] }}
                                </div>
                                <div class="ball blue-ball">
                                    {{ $dlt[0][6] }}
                                </div>
                            </div>
                        </div>
                        <div class="weui-cell__ft"></div>
                    </div>
                </li>

                <li class="kind-list__item">
                    <div id="mnxh" class="weui-flex kind-list__item-hd weui-cell weui-cell_access">
                        <div class="weui-flex__item">
                            <div class="index-title">
                                <span>模拟选号</span>
                            </div>
                            <div class="index-content">计算购买成本</div>
                        </div>
                        <div class="weui-cell__ft"></div>
                    </div>
                </li>

                <li class="kind-list__item">
                    <div id="zxsj" class="weui-flex kind-list__item-hd weui-cell weui-cell_access">
                        <div class="weui-flex__item">
                            <div class="index-title">
                                <span>自选随机</span>
                            </div>
                            <div class="index-content">自定义随机范围</div>
                        </div>
                        <div class="weui-cell__ft"></div>
                    </div>
                </li>
            </ul>

        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            var clipboard1 = new ClipboardJS('#today');
            clipboard1.on('success', function (e) {
                $.toast("复制成功");
            });

            clipboard1.on('error', function (e) {
                $.toast("复制失败", "cancel");
            });

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
                    document.getElementById('copy').click();
                    return this.random.slice(0, this.type === 0 ? 6 : 5).join(' ') + ' + ' + this.random.slice(this.type === 0 ? 6 : 5, 7).join(' ');
                }
            }
        });
    </script>
@endsection

