@extends('zho.login_4.index')
@section('title','数据管理')
@section('body')
    <center>
        <table border>
            <h3>当天</h3>
            <tr>
                <td>当天进入车辆</td>
                <td>收费</td>
            </tr>
            @foreach($data as $v)
                <tr>
                    <td>{{$v->name}}</td>
                    <td>
                        @if(($v->shijian)==null)
                            当前车辆未出库
                        @elseif(($v->shijian)!==null)
                            {{$v->qianshu}}元
                        @endif
                    </td>
                </tr>

            @endforeach

            <tr>
                <td>总收费</td>
                <td>{{$jiaqian}}元</td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <table border>
            <h3>总</h3>
            <tr>
                <td>总进入车辆</td>
                <td>收费</td>
            </tr>
            @foreach($dataa as $v)
                <tr>
                    <td>{{$v->name}}</td>
                    <td>
                        @if(($v->shijian)==null)
                            当前车辆未出库
                        @elseif(($v->shijian)!==null)
                            {{$v->qianshu}}元
                        @endif
                    </td>
                </tr>

            @endforeach

            <tr>
                <td>总收费</td>
                <td>{{$jiaqians}}元</td>
            </tr>
        </table>

    </center>
@endsection