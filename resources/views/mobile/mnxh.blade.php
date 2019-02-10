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
    <div class="page" style="padding-bottom: 60px">
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
                                                       @change="redChange(index * 7 + z)"/>@{{ reds[index * 7 + z].count % 3 === 2 && red_dans().indexOf(reds[index * 7 + z].name) !== -1 ? '胆' : reds[index * 7 + z].name }}</label>
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
                                                       @change="blueChange(index * 7 + z)"/>@{{ type ? (blues[index * 7 + z].name) : (blues[index * 7 + z].count % 3 === 2 && blue_dans().indexOf(blues[index * 7 + z].name) !== -1 ? '胆' : blues[index * 7 + z].name) }}</label>
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
            <div style='flex-grow:2;margin-left:15px;display: flex;'>
                <span class="zhu" v-cloak>共 @{{ all.length }} 注</span>
                <span class="yuan" v-cloak>@{{ all.length * 2 }} 元</span>
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
                var b = checked.indexOf(t) !== -1;
                arr.push({
                    value: i,
                    checked: b,
                    name: t,
                    count: b ? 1 : 0,
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
            data: {
                type: true,
                reds: nums(33),
                reds_p: [],
                red_line: [1, 2, 3, 4, 5],
                line_count: [1, 2, 3, 4, 5, 6, 7],
                blues: nums(16),
                blues_p: [],
            },
            created: function () {
                if (sessionStorage.mnxh_type) {
                    this.type = JSON.parse(sessionStorage.mnxh_type);
                }
                if (sessionStorage.mnxh_reds_p) {
                    this.reds_p = JSON.parse(sessionStorage.mnxh_reds_p);
                }
                if (sessionStorage.mnxh_blues_p) {
                    this.blues_p = JSON.parse(sessionStorage.mnxh_blues_p);
                }
                if (sessionStorage.mnxh_reds) {
                    this.reds = JSON.parse(sessionStorage.mnxh_reds);
                }
                if (sessionStorage.mnxh_blues) {
                    this.blues = JSON.parse(sessionStorage.mnxh_blues);
                }
            },
            computed: {
                all() {
                    var red_count = this.type ? 6 : 5;
                    var blue_count = this.type ? 1 : 2;

                    if (this.reds_p.length >= red_count && this.blues_p.length >= blue_count) {
                        var red_dans = this.red_dans();
                        var red_tuos = this.red_tuos();
                        var blue_dans = this.blue_dans();
                        var blue_tuos = this.blue_tuos();
                        if (red_dans.length > (this.type ? 5 : 4)) {
                            $.toast('红球胆只能选'+ (this.type ? 5 : 4) + '个', 'text');
                            return [];
                        }

                        if (blue_dans.length > 1) {
                            $.toast('蓝球胆只能选1个', 'text');
                            return [];
                        }

                        var ky = JSON.parse(JSON.stringify(red_tuos)).join(',');
                        var v = JSON.parse(JSON.stringify(red_tuos));
                        var all_red = collect(allzhu({ky:v}, (this.type ? 6 : 5) - red_dans.length)).values().toArray().reverse();

                        var red_temp = [];
                        if (red_dans.length > 0) {
                            for (var a in all_red) {
                                red_temp.push(all_red[a].concat(red_dans).sort());
                            }
                        } else {
                            red_temp = all_red;
                        }

                        var blue_temp = [];
                        if (this.type) {
                            for (var a in red_temp) {
                                for (var b in blue_tuos) {
                                    blue_temp.push(red_temp[a].concat([blue_tuos[b]]));
                                }
                            }

                        } else {
                            var temp = [];
                            if (blue_dans.length > 0) {
                                for (var a in blue_tuos) {
                                    var b = [blue_tuos[a]];
                                    b.push(blue_dans[0]);
                                    b.sort();
                                    temp.push(b);
                                }
                            } else {
                                if (blue_tuos.length < 3) {
                                    temp = [blue_tuos];
                                    console.log(temp);
                                } else {
                                    ky = JSON.parse(JSON.stringify(blue_tuos)).join(',');
                                    v = JSON.parse(JSON.stringify(blue_tuos));
                                    temp = collect(allzhu({ky:v}, 2)).values().toArray().reverse();
                                }
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
                copyText() {
                    var red = JSON.parse(JSON.stringify(this.reds_p)).sort().join(' ');
                    var blue = JSON.parse(JSON.stringify(this.blues_p)).sort().join(' ');
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
                }
            },
            methods: {
                savelocal() {
                    sessionStorage.mnxh_type=JSON.stringify(this.type);
                    sessionStorage.mnxh_reds_p=JSON.stringify(this.reds_p);
                    sessionStorage.mnxh_blues_p=JSON.stringify(this.blues_p);
                    sessionStorage.mnxh_reds=JSON.stringify(this.reds);
                    sessionStorage.mnxh_blues=JSON.stringify(this.blues);
                },
                red_dans() {
                    var red_dan = [];
                    var rs = JSON.parse(JSON.stringify(this.reds));
                    for (var a in rs) {
                        if (rs[a].checked && rs[a].count % 3 === 2) {
                            red_dan.push(rs[a].name);
                        }
                    }
                    return red_dan;
                },
                red_tuos() {
                    var red_tuo = [];
                    for (var a in this.reds) {
                        if (this.reds[a].checked && this.reds[a].count % 3 === 1) {
                            red_tuo.push(this.reds[a].name);
                        }
                    }
                    return red_tuo;
                },
                blue_dans() {
                    var blue_dan = [];
                    var bs = JSON.parse(JSON.stringify(this.blues));
                    for (var a in bs) {
                        if (bs[a].checked && bs[a].count % 3 === 2) {
                            blue_dan.push(bs[a].name);
                        }
                    }
                    return blue_dan;
                },
                blue_tuos() {
                    var blue_tuo = [];
                    for (var a in this.blues) {
                        if (this.type) {
                            if (this.blues[a].checked) {
                                blue_tuo.push(this.blues[a].name);
                            }
                        } else {
                            if (this.blues[a].checked && this.blues[a].count % 3 === 1) {
                                blue_tuo.push(this.blues[a].name);
                            }
                        }
                    }
                    return blue_tuo;
                },
                typeChange() {
                    this.type = !this.type;

                    this.blues = nums(this.type ? 16 : 12, this.blues_p);
                },
                redChange(e) {
                    if (this.reds_p.length > 20) {
                        this.reds_p.splice(2, 1);
                        $.toast('只能选择20个红球', 'text');
                        return;
                    }
                    var redl = this.red_dans().length;
                    if (redl > (this.type ? 4 : 3)) {
                        this.reds[e].count = this.reds[e].checked ? 0 : 1;
                        this.reds[e].checked = !this.reds[e].checked;
                        return;
                    }
                    this.reds[e].count += 1;
                    if (this.reds[e].count > 2) {
                        this.reds[e].count = 0;
                    }

                    if (this.reds[e].count % 3 === 2) {
                        this.reds_p.push(this.reds[e].name);
                    } else {
                        this.reds[e].checked = !this.reds[e].checked;
                    }
                },
                blueChange(e) {
                    var danl = this.blue_dans().length;
                    if (danl > 0) {
                        this.blues[e].count = this.blues[e].checked ? 0 : 1;
                        this.blues[e].checked = !this.blues[e].checked;
                        return;
                    }
                    this.blues[e].count += 1;
                    if (this.blues[e].count > 2) {
                        this.blues[e].count = 0;
                    }

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