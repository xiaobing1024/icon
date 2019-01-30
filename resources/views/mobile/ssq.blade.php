@extends('mobile.layouts.app')

@section('content')
    <div class="page" style="padding: 0 15px">
        <div class="page__bd page__bd_spacing">
            <div class="weui-cells">
                <div class="weui-cell" v-for="item in data" v-cloak>
                    <div class="weui-cell__bd">
                        <p>@{{ item.no_name }}</p>
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
                    {{--<div class="weui-cell__ft">说明文字</div>--}}
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
                data: {!! $data !!},
            }
        });
    </script>
@endsection