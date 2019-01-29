@extends('mobile.layouts.app')

@section('content')
    <div class="page" style="padding: 0 15px">
        <div class="page__bd page__bd_spacing">
            <div class="weui-cells">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <p>标题文字</p>
                        <div class="weui-flex" style="margin-top: 5px;">
                            <div class="ball">
                                1
                            </div>
                            <div class="ball">
                                2
                            </div>
                            <div class="ball">
                                3
                            </div>
                            <div class="ball">
                                4
                            </div>
                            <div class="ball">
                                5
                            </div>
                            <div class="ball">
                                6
                            </div>
                            <div class="ball blue-ball">
                                7
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
                type: 0,
            }
        });

    </script>
@endsection