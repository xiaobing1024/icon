@section('title', '许愿池')

@extends('mobile.layouts.app')

@section('content')
    <div class="page" style="padding: 0 15px">
        <div class="page__bd page__bd_spacing">
            <img src="https://s2.ax1x.com/2019/02/12/kdW1pT.jpg" style="width: 100%" alt="许愿池" title="许愿池" border="0"/>

            <img src="https://s2.ax1x.com/2019/02/12/kd7BOf.png" style="width: 100%"  alt="投币" title="投币" v-show="show">
            <div style="text-align: center" v-show="show">长按图片</div>

            <div style="text-align: center">
                <button @click="show=!show" class="weui-btn weui-btn_mini weui-btn_default"
                        style='margin-top:15px;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);' type="submit">
                    投币
                </button>
            </div>

            <form action="{{ url('cp/xyc') }}" method="post">
                {{ csrf_field() }}
                <div class="weui-cells__title">姓名</div>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" name="name" placeholder="输入昵称或姓名，女士或先生" required
                                   value="{{ old('name') }}">
                        </div>
                    </div>
                </div>

                <div class="weui-cells__title">愿望</div>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <textarea class="weui-textarea" placeholder="请输入愿望，保存后将会展示在网站中" name="msg" rows="3"
                                      required>{{ old('msg') }}</textarea>
                        </div>
                    </div>
                </div>

                <div style="text-align: center">
                    <button class="weui-btn weui-btn_mini weui-btn_primary"
                            style='margin-top:15px;color:#fff;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);' type="submit">
                        保存
                    </button>
                </div>
                <div style="text-align: center">
                    <a class="weui-btn weui-btn_mini weui-btn_warn" href="{{ url('cp/xyc_list') }}"
                       style='margin-top:15px;color:#fff;box-shadow: 0 1.5px 4px rgba(0, 0, 0, 0.24), 0 1.5px 6px rgba(0, 0, 0, 0.12);'>
                        所有愿望
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        new Vue({
            el: '.page',
            data: {
                show: false,
            }
        });
    </script>
    <script>
        @if(session('error', 0) == 1)
        $.toast('保存失败', 'text');
        @endif
    </script>
@endsection