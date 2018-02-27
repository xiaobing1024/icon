@extends('layouts.app')

@section('subTitle', '分类管理')

@section('css')
<link href="{{asset('/layer/mobile/need/layer.css')}}">
@endsection

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{url('admin')}}">Home</a></li>
        <li><a href="{{url('admin/font')}}">Font-Family</a></li>
    </ol>
    <div style="margin-bottom: 30px">
        <form class="bs-example bs-example-form" role="form"method="get"action="{{url('admin/font')}}">
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <input type="text" class="form-control" name="font_family" placeholder="请输入您想搜索的文字样式"value="{{$re or ''}}">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go!</button>
                    </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </form>
    </div>
    <p><a class="btn btn-primary btn-lg" href="{{url('admin/font/create')}}" role="button">添加Font</a></p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>文字</th>
            <th>文字样式</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($font as $v)
        <tr id="list{{$v->id}}">
            <td>{{$v->id}}</td>
            <td>{{$v->font}} </td>
            <td>{{$v->font_family}}</td>
            <td>{{$v->created_at}}</td>
            <td><a href="{{url('admin/font/'.$v->id.'/edit')}}">修改</a>&nbsp;<a id="del" href="#">删除</a></td>
        </tr>
        @endforeach
        {!! $font->links() !!}
        </tbody>
    </table>
@endsection
@section('js')
    <script src="{{asset('/layer/layer.js')}}"></script>
    <script>
        @foreach($font as $v)
       $('#list'+'{{$v->id}}').find('td #del').click(function () {
            layer.confirm('您确定要删除这条记录？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post('{{url('/admin/font/'.$v->id)}}',{'_method':'delete','_token':"{{csrf_token()}}",'id':"{{$v->id}}"},function (data) {
                    location.reload();
                    if (data.status==0)
                    {
                        layer.msg(data.msg, {icon: 6,time:1500});
                    }else{
                        layer.msg(data.msg, {icon: 5,time:1500});
                    }
                })
            })

        });

        @endforeach
    </script>
@endsection

