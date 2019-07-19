@extends('admin.layout.login')
@section('title','订单表')
@section('body')
<table border>
    <tr>
        <td>订单单号</td>
        <td>商品总价</td>
        <td>付款状态</td>
        <td>加入时间</td>
    </tr>
    @foreach ($data as $v)
    <tr>
        <td>{{$v->oid}}</td>
        <td>{{$v->pay_money}}</td>
        <td>
            @if($v->state==1)
                <a href="{{url('pays',['id'=>$v->id])}}">未支付</a>
            @elseif($v->state==2)
                已支付
            @else($v->state==3)
                订单过期
            @endif
            </td>
        <td>{{date("Y-m-d H:i:s",$v->add_time)}}</td>
    </tr>
        @endforeach
</table>
@endsection