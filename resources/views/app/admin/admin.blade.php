@extends('app.admin')
@section('title','商品展示')
@section('body')
    <script src="{{asset('bootstrap/jquery.min.js')}}"></script>

    <form action="">
        <select name="type_name" id="" width="160px">
            <option value="">请选择</option>
            @foreach($type as $v)
            <option value="{{$v->id}}">{{$v->name}}</option>
            @endforeach
        </select>
        <input type="text" name="sosuo" id="" value="{{$sosuo}}">
        <input type="submit" value=" 搜索 ">
    </form>
    <table class="table">
        <tr>
            <td>商品编号</td>
            <td>商品名称</td>
            <td>商品分类</td>
            <td>商品货号</td>
            <td>商品价格</td>
            <td>商品图片</td>
            <td>是否上架</td>
            <td>商品操作</td>
        </tr>
        @foreach($goods as $v)
        <tr>
            <td>{{$v->goods_id}}</td>
            <td value="{{$v->goods_id}}">
                <span class="gai1">{{$v->goods_name}}</span>
            </td>
            <td>{{$v->name}}</td>
            <td>{{$v->goods_hao}}</td>
            <td>{{$v->goods_price}}</td>
            <td><img src="{{$v->goods_img}}" width="60" alt=""></td>
            <td value="{{$v->goods_id}}">
                @if($v->zhuangtai == 1)
                    <span class="gai">下架</span>
                @else
                    <span class="gai">上架</span>
                @endif
            </td>
            <td>
                <a href="">删除</a>
            </td>
        </tr>

        @endforeach
    </table>
    <div align="center">
        {{ $goods->appends([ 'sosuo'=> $sosuo])->links() }}
    </div>
    <script>
        $('.gai').on('click',function () {
            var _this = $(this);
            var name = $(this).html();
            var id = $(this).parent().attr('value');
            // alert(id);
            $.ajax({
                url : "{{url('app/admin/admin_gai')}}",
                data : {id:id,name:name},
                dataType : 'json',
                type : 'post',
                success : function (res) {
                    _this.html(res.msg);
                }
            })
        })
    $(document).on('click','.gai1',function () {
        // alert(1);
        var name = $(this).html();
        var id = $(this).parent().attr('value');
        // alert(id);return;
        $(this).parent().html("<input type='text' class='fo' value='" + name + "'/>");
        $(".fo").focus();
        $(".fo").blur(function(){
            //获取到修改后的值
            var val = $(".fo").val();
            // alert(val);
            $(this).parent().html("<span  class='gai1'>"+val+"</span>");
            $.ajax({
                url : "{{url('app/admin/admin_do')}}",
                data : {id:id,name:val},
                type : 'post',
                success : function () {

                }
            })
         })

    })
    </script>
@endsection