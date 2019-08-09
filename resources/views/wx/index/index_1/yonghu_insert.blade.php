@extends('index.layout.login')
@section('title','关注用户展示')
@section('body')
    <center>
        <h2>用户</h2>
        <form action="{{url('wx/index/index_1/yonghu_insert_do')}}" method="post">
            @csrf
        <table border>
            <tr>
                <td>选择</td>
                <td>编号</td>
                <td>名</td>
                <td>时间</td>
                <td>openid</td>
                <td>是否关注</td>
                <td>操作</td>
            </tr>
            @foreach($data as $v)
                <tr>
                    <td><input type="checkbox" name="id_list[]" id="" value="{{$v->id}}"></td>
                    <td>{{$v->id}}</td>
                    <td>{{$v->ming}}</td>
                    <td>{{date ('Y-m-d H:i:s',$v->add_time)}}</td>
                    <td>{{$v->openid}}</td>
                    <td>
                        @if($v->subscribe==1)
                            已关注
                        @else
                            未关注
                        @endif
                    </td>
                    <td>
                        <a href="{{url('wx/index/index_1/index_4',['id'=>$v->id])}}">查看用户详情</a>
{{--                        <a href="">查看用户标签</a>--}}
                    </td>
                </tr>
            @endforeach
        </table>
            <input type="hidden" name="tagid" value="{{$id}}">
            <input type="submit" value="添加">
        </form>
    </center>
@endsection
