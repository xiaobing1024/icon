@section('title', '所有愿望')

@extends('mobile.layouts.app')

@section('content')
    <div class="page" style="padding: 0 15px">
        <div class="page__bd page__bd_spacing">
                <template  v-for="item in data" >
                    <div class="weui-cells__title">
                        @{{ item.name }}
                        <span style="margin-left: 50px">@{{ item.updated_at }}</span>
                    </div>

                    {{--<div class="weui-cells">--}}
                    <div class="weui-cell">
                        <div class="weui-cell__bd">@{{ item.msg }}</div>
                    </div>
                    {{--</div>--}}
                </template>
            <div v-if="canload">
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
    </div>
@endsection

@section('js')
    <script>
        new Vue({
            el: '.page',
            data: {
                loading: false,
                canload: {{ count($data) == 21 ? 'true' : 'false' }},
                data: {!! count($data) == 21 ? $data->take(20) : $data !!},
                page: 1,
            },
            methods: {
                loadmore: function () {
                    var that = this;
                    this.loading = true;
                    $.ajax({
                        url: "{{ url('cp/xyc_list_api') }}",
                        data: {page: this.page + 1},
                        success: function (result) {
                            that.page = result.data.current_page;
                            if (result.code === 1) {
                                if (result.data.data.length > 0) {
                                    that.data = that.data.concat(result.data.data);
                                }
                                if (result.data.next_page_url) {
                                    that.canload = true;
                                } else {
                                    that.canload = false;
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