@extends('app.admin')
@section('title','货品添加')
@section('body')
    <script src="{{asset('bootstrap/jquery.min.js')}}"></script>
    <h3>货品添加</h3>
    <form action="{{url('app/admin/care_do')}}" method="post">
    <table width="100%" id="table_list" class='table'>
        <tbody id="aa">
        <tr>
            <th colspan="20" scope="col">商品名称:{{$goods->goods_name}}  &nbsp;&nbsp;&nbsp; 货号:{{$goods->goods_hao}}
                <input type="hidden" name="goods_id" value="{{$goods->goods_id}}">
            </th>

        </tr>

        <tr>
            <!-- start for specifications -->
            @foreach($data as $k=>$v)
            <td scope="col"><div align="center"><strong>{{$k}}</strong></div></td>
            @endforeach
{{--            <td scope="col"><div align="center"><strong>颜色</strong></div></td>--}}
            <!-- end for specifications -->
            <td class="label_2">货号</td>
            <td class="label_2">库存</td>
            <td class="label_2">&nbsp;</td>
        </tr>

        <tr id="attr_row">
            <!-- start for specifications_value -->
            @foreach($data as $k=>$v)
            <td align="center" style="background-color: rgb(255, 255, 255);">
                    <select name="goods_attr[]">
                        <option value="" selected="">请选择...</option>
                        @foreach($v as $vo)
                    <option value="{{$vo->shuxingzhi}}">{{$vo->shuxingzhi}}</option>
                    @endforeach
                </select>
            </td>
            @endforeach
{{--            <td align="center" style="background-color: rgb(255, 255, 255);">--}}
{{--                <select name="attr[214][]">--}}
{{--                    <option value="" selected="">请选择...</option>--}}
{{--                    <option value="土豪金">土豪金</option>--}}
{{--                    <option value="太空灰">太空灰</option>--}}
{{--                </select>--}}
{{--            </td>--}}
            <!-- end for specifications_value -->
            <td class="label_2" style="background-color: rgb(250,255,255);"><input type="text" name="product_sn[]" value="" size="20"></td>
            <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_number[]" value="1" size="10"></td>
            <td style="background-color: rgb(255, 255, 255);"><input type="button" class="button1" value="+" ></td>
        </tr>

        <tr>
            <td align="center" colspan="5" style="background-color: rgb(255, 255, 255);">
                <input type="submit" class="button" value="保存">
            </td>
        </tr>
        </tbody>
    </table>
    </form>
    <script>
        $(document).on('click','.button1',function () {
                // alert(1);
            var _this = $(this);
            var name = $(this).val();
            // console.log(html);
            if(name == '+' ){
                $(this).val(' -');
                var html = $(this).parents('tr').clone();
                $('#attr_row').after(html);
                $(this).val('+');
            }else{
                $(this).parents('tr').remove();
            }
        })
    </script>
@endsection