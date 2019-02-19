@section('title', '自选随机')

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
            justify-content: space-between;
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
                         v-bind:class="(ball_type ? '' : 'item_blue ') + (balls[index * 7 + z].checked ? (ball_type ? 'is_checked' : 'is_checked_blue') : '')">
                        <label class="checkbox">
                            <input type="checkbox" hidden="false" v-bind:value="balls[index * 7 + z].name" v-model="balls[index * 7 + z].checked"/>@{{ balls[index * 7 + z].name }}</label>
                    </div>

                    <div v-else class="item item-hidden">
                        <label for="" class="checkbox checkbox-hidden">88</label>
                    </div>
                </template>
            </div>

            <div style="height:1px;background-color:#f0f0e8;margin-top:15px"></div>

            <div class="pick_ball" v-for="(i, index) in pick_line">
                <template v-for="(j, z) in line_count">
                    <div v-if="(index * 7 + z) < pick_ball.length" class="item"
                         v-bind:class="(pick_ball[index * 7 + z].type ? '' : 'item_blue ') + (pick_ball[index * 7 + z].type ? 'is_checked' : 'is_checked_blue')">
                        <label class="checkbox" @click="deletepick(index * 7 + z)">@{{ pick_ball[index * 7 + z].name }}</label>
                    </div>

                    <div v-else class="item item-hidden">
                        <label for="" class="checkbox checkbox-hidden">88</label>
                    </div>
                </template>
            </div>
        </div>

        <div class="weui-cells" style="margin-top: 15px">
            <a class="weui-cell weui-cell_access" v-for="item in all" @click="savelocal" v-bind:href="'/cp/' + (type ? 'ssq_search':'dlt_search') + '?kw=' + item.slice(0 , type ? 6 : 5).join(',')" v-cloak>
                <div class="weui-cell__bd">
                    <div class="weui-flex" style="margin-top: 5px;">
                        <div class="ball">
                            @{{ item[0] }}
                        </div>
                        <div class="ball">
                            @{{ item[1] }}
                        </div>
                        <div class="ball">
                            @{{ item[2] }}
                        </div>
                        <div class="ball">
                            @{{ item[3] }}
                        </div>
                        <div class="ball">
                            @{{ item[4] }}
                        </div>
                        <div class="ball" v-bind:class="type ? '' : 'blue-ball'">
                            @{{ item[5] }}
                        </div>
                        <div class="ball blue-ball">
                            @{{ item[6] }}
                        </div>
                    </div>
                </div>
                <div class="weui-cell__ft"></div>
            </a>
        </div>

        <div class="weui-footer weui-footer_fixed-bottom">
            <div>
                <button class="weui-btn weui-btn_mini weui-btn_primary"
                        style='margin-left:15px;color:#fff;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);'
                        v-on:click="clean">清空
                </button>
            </div>
            <div>
                <button class="weui-btn weui-btn_mini weui-btn_warn"
                        style='color:#fff;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);'
                        v-on:click="pickall">全选
                </button>
            </div>
            {{--<div>取 <input type="number" min="1" max="35" v-model="pick_count"/> 个</div>--}}
            <div>取<select v-model="pick_count">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                </select>个</div>
            <div>
            <button id="copy" class="weui-btn weui-btn_mini weui-btn_default"
                    style="margin-right:15px;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);"
                    @click="gorandom">开始随机
            </button>
            </div>
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

        function allzhu(arr, end = 6) {
            var temp = [];
            if (end === 1) {
                for (var k in arr) {
                    for (var a in arr[k]) {
                        temp[a] = [arr[k][a]];
                    }
                }
                return temp;
            }
            var c = 0;
            for (var k in arr) {
                c = arr[k].length;
                if (c === end) {
                    return arr;
                }
                for (var i = 0; i < c; i++) {
                    var t = arr[k].concat();
                    t.splice(i, 1);
                    temp[t.sort().join(',')] = t.sort();
                }
            }

            return allzhu(temp, end);
        }

        new Vue({
            el: '.page',
            created: function () {
                if (sessionStorage.zxsj_pick_red) {
                    this.pick_red = JSON.parse(sessionStorage.zxsj_pick_red);
                }
                if (sessionStorage.zxsj_pick_blue) {
                    this.pick_blue = JSON.parse(sessionStorage.zxsj_pick_blue);
                }
            },
            data: {
                type: true,
                ball_type: true,
                pick_red: [],
                pick_blue: [],
                balls: nums(33),
                line_count: [1, 2, 3, 4, 5, 6, 7],
                pick_count: 1
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
                    var r = JSON.parse(JSON.stringify(this.pick_red)).sort().join(' ');
                    var b = JSON.parse(JSON.stringify(this.pick_blue)).sort().join(' ');

                    if (b.length < 1) {
                        return r;
                    }

                    if (r.length < 1) {
                        return b;
                    }

                    return r + ' + ' + b;
                },
                cancopy() {
                    return {
                        'weui-btn_disabled': (this.pick_ball.length < 1)
                    };
                },
                pick_ball() {
                    var arr = [];
                    for (var a in this.pick_red) {
                        arr.push({
                            name:this.pick_red[a],
                            type:true
                        });
                    }
                    for (var a in this.pick_blue) {
                        arr.push({
                            name:this.pick_blue[a],
                            type:false
                        });
                    }
                    return arr;
                },
                pick_line() {
                    var arr = [];
                    for (var i = 0, j = Math.floor(this.pick_ball.length / 7) + 1; i < j; i++) {
                        arr.push(i + 1);
                    }
                    return arr;
                },
                all() {
                    var red_count = this.type ? 6 : 5;
                    var blue_count = this.type ? 1 : 2;

                    if (this.pick_red.length >= red_count && this.pick_blue.length >= blue_count) {
                        var ky = JSON.parse(JSON.stringify(this.pick_red)).sort().join(',');
                        var v = JSON.parse(JSON.stringify(this.pick_red)).sort();
                        var red_temp = collect(allzhu({ky:v})).values().toArray().reverse();

                        var blue_temp = [];
                        if (this.type) {
                            for (var a in red_temp) {
                                for (var b in this.pick_blue) {
                                    blue_temp.push(red_temp[a].concat([this.pick_blue[b]]));
                                }
                            }
                        } else {
                            var temp = [];
                            v = JSON.parse(JSON.stringify(this.pick_blue)).sort();
                            if (this.pick_blue.length < 3) {
                                temp = [v];
                            } else {
                                ky = JSON.parse(JSON.stringify(this.pick_blue)).sort().join(',');
                                temp = collect(allzhu({ky:v}, 2)).values().toArray().reverse();
                            }

                            for (var a in red_temp) {
                                for (var b in temp) {
                                    blue_temp.push(red_temp[a].concat(temp[b].sort()));
                                }
                            }
                        }

                        return blue_temp;
                    }

                    return [];
                },
            },
            methods: {
                savelocal() {
                    sessionStorage.zxsj_pick_red=JSON.stringify(this.pick_red);
                    sessionStorage.zxsj_pick_blue=JSON.stringify(this.pick_blue);
                },
                typeChange() {
                    this.type = !this.type;

                    this.balls = nums(this.type ? (this.ball_type ? 33 : 16) : (this.ball_type ? 35 : 12));
                },
                changeBallType() {
                    this.ball_type = !this.ball_type;

                    this.balls = nums(this.type ? (this.ball_type ? 33 : 16) : (this.ball_type ? 35 : 12));
                },
                gorandom() {
                    if (this.pick_count < 1) {
                        $.toast('最少取一个', 'text');
                        return;
                    }
                    var c = collect(JSON.parse(JSON.stringify(this.balls))).where('checked', true);
                    if (c.count() < 1) {
                        $.toast('先选择需要随机的数字', 'text');
                        return;
                    }
                    var ct = Math.min(c.count(), this.pick_count);
                    var a = c.random(ct).toArray();
                    if (this.ball_type) {
                        for (var b in a) {
                            if (this.pick_red.indexOf(a[b].name) === -1) {
                                this.pick_red.push(a[b].name);
                            }
                        }
                    } else {
                        for (var b in a) {
                            if (this.pick_blue.indexOf(a[b].name) === -1) {
                                this.pick_blue.push(a[b].name);
                            }
                        }
                    }
                },
                deletepick(i) {
                    if (this.pick_ball[i].type) {
                        this.pick_red.splice(this.pick_red.indexOf(this.pick_ball[i].name), 1);
                    } else {
                        this.pick_blue.splice(this.pick_blue.indexOf(this.pick_ball[i].name), 1);
                    }
                },
                clean() {
                    this.balls = nums(this.type ? (this.ball_type ? 33 : 16) : (this.ball_type ? 35 : 12));
                },
                pickall() {
                    for (var a in this.balls) {
                        this.balls[a].checked = true;
                    }
                }
            }
        });
    </script>

@endsection