@extends('index.layout.login')
@section('title','用户标签添加')
@section('body')
    <center>
        <h3>
            <a href="{{url('wx/index/index_1/get_yonghu')}}">添加用户标签</a>
        </h3>
       <table border>
           <tr>
               <td>id号</td>
               <td>标签组名</td>
               <td>标记rshu</td>
               <td align="center">操作</td>
           </tr>
           @foreach($data as $v)
           <tr>
               <td>{{$v['id']}}</td>
               <td>{{$v['name']}}</td>
               <td>{{$v['count']}}</td>
               <td>
                   <a href="{{url('wx/index/index_1/yonghu_insert',['id'=>$v['id']])}}">添加用户</a>
                   <a href="{{url('wx/index/index_1/yonghu_select',['id'=>$v['id']])}}">用户列表详情</a>
                   <a href="{{url('wx/index/index_1/yonghu_delete',['id'=>$v['id']])}}">删除标签</a>
                   <a href="{{url('wx/index/index_1/yonghu_update',['id'=>$v['id']])}}?name={{$v['name']}}">修改</a>
                   <a href="{{url('wx/index/index_1/yonghu_xiaoxi',['id'=>$v['id']])}}">消息推送</a>
{{--                   <a href="{{url('wx/index/index_1/yonghu_delete')}}?id={{$v['id']}}">删除</a>--}}
               </td>
           </tr>
           @endforeach
       </table>
    </center>
@endsection
