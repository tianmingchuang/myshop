@extends('index.layout.login')
@section('title','关注用户展示')
@section('body')
    <center>
        <h2>信息展示</h2>
        <h3><a href="{{url('wx/index/index_1/index_2')}}">数据刷新</a></h3>
        <h3><a href="{{url('wx/index/index_1/erwma')}}">生成二维码</a></h3>
        <table border>
            <tr>
{{--                <td>选择</td>--}}
                <td>编号</td>
                <td>名</td>
                <td>时间</td>
                <td>openid</td>
                <td>是否关注</td>
                <td>操作</td>
            </tr>
            @foreach($data as $v)
                <tr>
{{--                    <td><input type="checkbox" name="id_list[]" id="" value="{{$v->id}}"></td>--}}
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
                        <a href="{{url('wx/index/index_1/yonghu_select_1',['id'=>$v->id])}}">查看用户标签</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </center>
@endsection
