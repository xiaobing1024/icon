@extends('mobile.layouts.app')

@section('css')
    <style>
        .fixhead {
            display: flex;
            justify-content: space-between;
            background-color: #252626;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .pick_ball {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            margin-left: 15px;
            margin-right: 15px;
        }

        .item {
            display: inline-block;
            width: 35px;
            height: 35px;
            background-color: #fff;
            border-radius: 50%;
            font-size: 17px;
            color: #fe2e2e;
            border-color: #e2e2df;
            border-width: thin;
            border-style: solid;
        }

        .item-hidden {
            border-color: #fff;
            background-color: #fff;
        }

        .checkbox {
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 35px;
        }

        .checkbox-hidden {
            color: #fff;
        }

        .is_checked {
            border: thin solid #fe2e2e;
            color: #fff;
            background: #fe2e2e;
        }

        .item_blue {
            color: #29a3f6;
        }

        .is_checked_blue {
            border: thin solid #29a3f6;
            color: #fff;
            background: #29a3f6;
        }

        .weui-footer {
            display: flex;
            justify-content: space-around;
            background-color: #252626;
            bottom: 0;
            padding-top: 10px;
            padding-bottom: 10px;
            align-items: baseline;
        }
    </style>
@endsection

@section('content')
    <div class="page" style="padding-bottom: 60px">
        <div class="fixhead" style="align-items:baseline">
            <div>
                <button class="weui-btn weui-btn_mini weui-btn_primary"
                        style='margin-left:15px;color:#fff;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);'
                        v-on:click="typeChange">切换
                </button>
            </div>
            <div>
                <button class="weui-btn weui-btn_mini weui-btn_default"
                        style='margin-right:15px;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);'
                        v-on:click="changeBallType" v-cloak>@{{ b }}
                </button>
            </div>
            <div>
                <span style='color:#fff;' v-cloak>@{{ t }}</span>
            </div>
            <div>
                <button id="copy" class="weui-btn weui-btn_mini weui-btn_warn" v-bind:class="cancopy"
                        style='margin-right:15px;color:#fff;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);'
                        v-bind:data-clipboard-text="copyText">复制
                </button>
            </div>
        </div>

        <div class="page__bd page__bd_spacing">
            <div class="pick_ball" v-for="(i, index) in line">
                <template v-for="(j, z) in line_count">
                    <div v-if="(index * 7 + z) < balls.length" class="item"
                         v-bind:class="ball_type ? '' : 'item_blue'"
                         v-bind:class="balls[index * 7 + z].checked ? (ball_type ? 'is_checked' : 'is_checked_blue') : ''"
                         >
                        <label class="checkbox">
                            <input type="checkbox" hidden="false" v-bind:value="balls[index * 7 + z].name" v-model="balls[index * 7 + z].checked"/>@{{ balls[index * 7 + z].name }}</label>
                    </div>

                    <div v-else class="item item-hidden">
                        <label for="" class="checkbox checkbox-hidden">88</label>
                    </div>
                </template>
            </div>

            <div style="height:1px;background-color:#f0f0e8;margin-top:15px"></div>
        </div>

        <div class="weui-footer weui-footer_fixed-bottom">
            <div>
                <button class="weui-btn weui-btn_mini weui-btn_primary"
                        style='margin-left:15px;color:#fff;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);'
                        v-on:click="clean">清空
                </button>
            </div>
            <button id="copy" class="weui-btn weui-btn_mini weui-btn_default"
                    style="margin-right:15px;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);"
                    @click="clean">清空
            </button>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(function () {
            var clipboard = new ClipboardJS('#copy');
            clipboard.on('success', function (e) {
                $.toast("复制成功");

            });

            clipboard.on('error', function (e) {
                $.toast("复制失败", "cancel");
            });
        });
    </script>

    <script>
        function nums(c, checked = []) {
            var arr = [];
            for (var i = 1; i <= c; i++) {
                var t = i < 10 ? '0' + i : String(i);
                var b = checked.indexOf(t) !== -1;
                arr.push({
                    value: i,
                    checked: b,
                    name: t
                });
            }
            return arr;
        }

        new Vue({
            el: '.page',
            data: {
                type: true,
                ball_type: true,
                pick_ball: [],
                balls: nums(33),
                line_count: [1, 2, 3, 4, 5, 6, 7],
            },
            computed: {
                t() {
                    return this.type ? '双色球' : '大乐透';
                },
                b() {
                    return this.ball_type ? '切蓝球' : '切红球';
                },
                line() {
                    if (!this.type && !this.ball_type) {
                        return [1, 2];
                    } else if (this.type && !this.ball_type) {
                        return [1, 2, 3];
                    }
                    return [1, 2, 3, 4, 5];
                },
                copyText() {
                    return '';
                },
                cancopy() {
                    return {
                        'weui-btn_disabled': (this.pick_ball.length < 1)
                    };
                }
            },
            methods: {
                typeChange() {
                    this.type = !this.type;

                    this.balls = nums(this.type ? (this.ball_type ? 33 : 16) : (this.ball_type ? 35 : 12));
                },
                changeBallType() {
                    this.ball_type = !this.ball_type;

                    this.balls = nums(this.type ? (this.ball_type ? 33 : 16) : (this.ball_type ? 35 : 12));
                },
                gorandom() {

                },
                clean() {

                }
            }
        });
    </script>

@endsection