@extends('index.layout.login')
@section('title','消息推送')
@section('body')
    <center>
        <h3>消息推送</h3>
        <form action="{{url('wx/index/index_1/yonghu_xiaoxi_do')}}" method="post">
            @csrf
            <input type="hidden" name="tag_id" value="{{$id}}">
            <div class="layui-form-item layui-form-text">
                <div class="layui-input-block">
                    <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
                    <input type="submit" value="确定推送">
                </div>
            </div>
        </form>
    </center>
@endsection
