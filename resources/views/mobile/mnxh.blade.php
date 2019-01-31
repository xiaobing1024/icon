@extends('mobile.layouts.app')

@section('css')
    <style>
        .fixhead {
            display: flex;
            justify-content: space-around;
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

        button {
            display: inline;
        }

        .zhu {
            margin-right: 15px;
            color: #fff;
        }

        .yuan {
            color: #feba01;
        }
    </style>
@endsection

@section('content')
    <div class="page">
        <div class="weui-flex fixhead" style="align-items:baseline">
            <button class="weui-btn weui-btn_mini weui-btn_primary"
                    style='margin-left:15px;color:#fff;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);'
                    v-on:click="typeChange">切换
            </button>
            <span style='color:#fff;line-height:29px;' v-cloak>@{{ t }}</span>
            <button id="copy" class="weui-btn weui-btn_mini weui-btn_warn" v-bind:class="cancopy"
                    style='margin-right:15px;color:#fff;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);'
                    v-bind:data-clipboard-text="copyText">复制
            </button>
        </div>

        <div class="page__bd page__bd_spacing">
            <div class="pick_ball" v-for="(i, index) in red_line">
                <template v-for="(j, z) in line_count">
                    <div v-if="(index * 7 + z) < reds.length" class="item"
                         v-bind:class="reds[index * 7 + z].checked ? 'is_checked' : ''">
                        <label class="checkbox"><input type="checkbox" hidden="false"
                                                       v-bind:value="reds[index * 7 + z].name" v-model="reds_p"
                                                       @change="redChange(index * 7 + z)"/>@{{ reds[index * 7 + z].count % 3 === 2 ? '胆' : reds[index * 7 + z].name }}</label>
                    </div>

                    <div v-else class="item item-hidden">
                        <label for="" class="checkbox checkbox-hidden">88</label>
                    </div>
                </template>
            </div>

            <div style="height:1px;background-color:#f0f0e8;margin-top:15px"></div>

            <div class="pick_ball" v-for="(i, index) in blue_line">
                <template v-for="(j, z) in line_count">
                    <div v-if="(index * 7 + z) < blues.length" class="item item_blue"
                         v-bind:class="blues[index * 7 + z].checked ? 'is_checked_blue' : ''">
                        <label class="checkbox"><input type="checkbox" hidden="false"
                                                       v-bind:value="blues[index * 7 + z].name" v-model="blues_p"
                                                       @change="blueChange(index * 7 + z)"/>@{{ type ? (blues[index * 7 + z].name) : (blues[index * 7 + z].count % 3 === 2 ? '胆' : blues[index * 7 + z].name) }}</label>
                    </div>

                    <div v-else class="item item-hidden">
                        <label for="" class="checkbox checkbox-hidden">88</label>
                    </div>
                </template>
            </div>
        </div>

        <div style="height:1px;background-color:#f0f0e8;margin-top:15px"></div>

        <div class="weui-footer weui-footer_fixed-bottom">
            <div style='flex-grow:2;margin-left:15px;display: flex;'>
                <span class="zhu" v-cloak>共 @{{ zhu }} 注</span>
                <span class="yuan" v-cloak>@{{ zhu * 2 }} 元</span>
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

        function nums(c, checked = []) {
            var arr = [];
            for (var i = 1; i <= c; i++) {
                var t = i < 10 ? '0' + i : String(i);
                arr.push({
                    value: i,
                    checked: checked.indexOf(t) !== -1,
                    name: t,
                    count: 0,
                });
            }
            return arr;
        }

        function factorial(num) {
            for (var i = num - 1; i >= 1; i--) {
                num *= i;
            }
            return num;
        }

        new Vue({
            el: '.page',
            data: {
                type: true,
                reds: nums(33),
                reds_p: [],
                red_line: [1, 2, 3, 4, 5],
                line_count: [1, 2, 3, 4, 5, 6, 7],
                blues: nums(16),
                blues_p: [],
            },
            computed: {
                all() {
                    var red_count = this.type ? 6 : 5;
                    var blue_count = this.type ? 1 : 2;

                    if (this.reds_p.length >= red_count && this.blues_p.length >= blue_count) {
                        var dan = [];
                        var tuo = [];

                        this.reds_p.sort().map(function (v) {
                            // if () {
                            //
                            // } else {
                            //
                            // }
                        })
                    }

                    return [];
                },
                copyText() {
                    var red = this.reds_p.sort().join(' ');
                    var blue = this.blues_p.sort().join(' ');
                    if (blue.length < 1) {
                        return red;
                    }
                    if (red.length < 1) {
                        return blue;
                    }
                    return red + ' + ' + blue;
                },
                cancopy() {
                    return {
                        'weui-btn_disabled': (this.reds_p.length < 1 && this.blues_p.length < 1)
                    };
                },
                t() {
                    return this.type ? '双色球' : '大乐透';
                },
                blue_line() {
                    return this.type ? [1, 2, 3] : [1, 2];
                },
                zhu() {
                    // var red_len = this.reds_p.length;
                    // var blue_len = this.blues_p.length;
                    // var red_count = this.type ? 6 : 5;
                    // var blue_count = this.type ? 1 : 2;
                    //
                    // if (red_len == red_count && blue_len == blue_count) {
                    //     return 1;
                    // } else if (red_len == red_count && blue_len >= blue_count) {
                    //     if (this.type) {
                    //         return blue_len;
                    //     } else {
                    //         return factorial(blue_len) / (factorial(blue_len - blue_count) * 2);
                    //     }
                    // } else if (red_len > red_count && blue_len == blue_count) {
                    //     return factorial(red_len) / (factorial(red_len - red_count) * factorial(red_count));
                    // } else if (red_len > red_count && blue_len > blue_count) {
                    //     if (this.type) {
                    //         return factorial(red_len) / (factorial(red_len - red_count) * factorial(red_count)) * blue_len;
                    //     } else {
                    //         return factorial(red_len) / (factorial(red_len - red_count) * factorial(red_count)) * (factorial(blue_len) / (factorial(blue_len - blue_count) * 2));
                    //     }
                    // }
                    return 0;
                }
            },
            methods: {
                typeChange() {
                    this.type = !this.type;
                },
                redChange(e) {
                    if (this.reds_p.length > 20) {
                        this.reds_p.splice(2, 1);
                        $.toast('只能选择20个红球', 'text');
                        return;
                    }
                    this.reds[e].count += 1;

                    if (this.reds[e].count % 3 === 2) {
                        this.reds_p.push(this.reds[e].name);
                    } else {
                        this.reds[e].checked = !this.reds[e].checked;
                    }
                },
                blueChange(e) {
                    this.blues[e].count += 1;
                    if (!this.type && this.blues[e].count % 3 === 2) {
                        this.blues_p.push(this.blues[e].name);
                    } else {
                        this.blues[e].checked = !this.blues[e].checked;
                    }
                },
                clean() {
                    this.reds_p = [];
                    this.blues_p = [];
                    this.reds = nums(this.type ? 33 : 35);
                    this.blues = nums(this.type ? 16 : 12);
                }
            },
            watch: {
                type: function (val) {
                    if (val) {
                        this.reds.splice(33, 2);
                        this.blues = this.blues.concat([
                            {
                                value: 13,
                                checked: false,
                                name: '13',
                                count: 0,
                            },
                            {
                                value: 14,
                                checked: false,
                                name: '14',
                                count: 0,
                            },
                            {
                                value: 15,
                                checked: false,
                                name: '14',
                                count: 0,
                            },
                            {
                                value: 16,
                                checked: false,
                                name: '16',
                                count: 0,
                            }
                        ]);
                    } else {
                        this.reds = this.reds.concat([
                            {
                                value: 34,
                                checked: false,
                                name: '34',
                                count: 0,
                            },
                            {
                                value: 35,
                                checked: false,
                                name: '35',
                                count: 0,
                            }
                        ]);
                        this.blues.splice(12, 4);
                    }

                    this.reds_p = this.reds_p.filter(function (element) {
                        return parseInt(element) <= (this.type ? 35 : 33);
                    });
                    this.blues_p = this.blues_p.filter(function (element) {
                        return parseInt(element) <= (this.type ? 12 : 16);
                    });
                }
            }
        });
    </script>
@endsection