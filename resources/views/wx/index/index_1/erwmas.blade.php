@extends('index.layout.login')
@section('title','生成二维码')
@section('body')
    <center>
{{--        <form action="{{url('wx/index/index_1/erwmas_do')}}" method="post">--}}
            <table border>
                <tr align="center">
                    <td>编号</td>
                    <td>名称</td>
                    <td>扫描人数</td>
                    <td>二维码url</td>
                    <td>操作</td>
                </tr>
                @foreach($data as $v)
                <tr align="center">
                    <td>{{$v->id}}</td>
                    <td>{{$v->name}}</td>
                    <td>{{$v->agent}}</td>
                    <td>
                        @if($v->qrcode_url=='')
                            尚未生成
                            @else
                            <img src="{{$v->qrcode_url}}" width="40" alt="">

                            @endif
                    </td>
                    <td>

                            <a href="{{url('wx/index/index_1/erwmas_do_1',['id'=>$v->id])}}">用户推广列表</a>

                        @if($v->agent_code=='')
                            <a href="{{url('wx/index/index_1/erwmas_do',['id'=>$v->id])}}">生成二维码</a>
                        @else
                          已生成
                        @endif

                        @if($v->agent_code=='')
                            尚未生成无法查看
                        @else
                            <a href="{{$v->qrcode_url}}">查看二维码</a>
                        @endif


                    </td>
                </tr>
                @endforeach
            </table>
{{--        </form>--}}
    </center>
@endsection
