@section('title', '双色球')

@extends('mobile.layouts.app')

@section('content')
    <div class="page" style="padding: 0 15px">
        <div class="page__bd page__bd_spacing">
            <div class="weui-cells">
                <div class="weui-cell" v-for="item in data" v-cloak>
                    <div class="weui-cell__bd">
                        <div class="weui-flex" style="justify-content:space-between;align-items:baseline">
                            <p>@{{ item.no_name }}</p>
                            <p style="color:#999;font-size: 14px">@{{ item.day }}</p>
                        </div>
                        <div class="weui-flex" style="margin-top: 5px;">
                            <div class="ball">
                                @{{ item.number_name[0] }}
                            </div>
                            <div class="ball">
                                @{{ item.number_name[1] }}
                            </div>
                            <div class="ball">
                                @{{ item.number_name[2] }}
                            </div>
                            <div class="ball">
                                @{{ item.number_name[3] }}
                            </div>
                            <div class="ball">
                                @{{ item.number_name[4] }}
                            </div>
                            <div class="ball">
                                @{{ item.number_name[5] }}
                            </div>
                            <div class="ball blue-ball">
                                @{{ item.number_name[6] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="weui-loadmore" v-bind:style="{display: this.loading ? 'block' : 'none'}">
                <i class="weui-loading"></i>
                <span class="weui-loadmore__tips">正在加载</span>
            </div>
            <div class="weui-loadmore weui-loadmore_line" style="display:none"
                 v-bind:style="{display: this.loading ? 'none' : 'block'}">
                <span class="weui-loadmore__tips">
                    <button class="weui-btn weui-btn_mini weui-btn_primary"
                            style="box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);height: 29px"
                            v-on:click.self="loadmore">加载更多</button>
                </span>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        new Vue({
            el: '.page',
            data: {
                loading: false,
                data: {!! $data !!},
                page: 1
            },
            methods: {
                loadmore: function () {
                    var that = this;
                    this.loading = true;
                    $.ajax({
                        url: "{{ url('api/ssq') }}",
                        data: {page: this.page + 1},
                        success: function (result) {
                            that.page = result.data.current_page;
                            if (result.code === 1) {
                                if (result.data.data.length > 0) {
                                    that.data = that.data.concat(result.data.data);
                                }
                            } else {
                                $.toast(result.msg);
                            }
                        },
                        error: function () {
                            $.toast('加载失败', 'text');
                        },
                        complete: function () {
                            that.loading = false;
                        }
                    });
                }
            }
        });
    </script>
@endsection