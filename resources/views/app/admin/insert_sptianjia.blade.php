@extends('app.admin')
@section('title','商品添加')
@section('body')
{{--    <link rel="stylesheet" href="{{asset('bootstrap/bootstrap.min.css')}}">--}}
{{--    <script src="{{asset('bootstrap/bootstrap.min.js')}}"></script>--}}
    <script src="{{asset('bootstrap/jquery.min.js')}}"></script>
    <center>
        <h3>商品添加</h3>
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="javascript:;" name='basic'>基本信息</a></li>
            <li role="presentation" ><a href="javascript:;" name='attr'>商品属性</a></li>
            <li role="presentation" ><a href="javascript:;" name='detail'>商品详情</a></li>
        </ul>
        <br>
        <form action='{{url("app/admin/insert_sptianjia_do")}}' method="POST" enctype="multipart/form-data" id='form'>

            <div class='div_basic div_form'>
                <div class="form-group">
                    <label for="exampleInputEmail1">商品名称</label>
                    <input type="text" class="form-control" name='goods_name'>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">商品分类</label>
                    <select class="form-control" name='cat_id'>
                        <option value='0'>请选择</option>
                        @foreach($category as $v)
                        <option value="{{$v->id}}">{{$v->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">商品货号</label>
                    <input type="text" class="form-control" name='goods_hao'>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">商品价钱</label>
                    <input type="text" class="form-control" name='goods_price'>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">商品图片</label>
                    <input type="file" name='file'>
                </div>
            </div>
            <div class='div_detail div_form' style='display:none'>
                <div class="form-group">
                    <label for="exampleInputFile">商品详情</label>
                    <textarea class="form-control" rows="3"></textarea>
                </div>
            </div>
            <div class='div_attr div_form' style='display:none'>
                <div class="form-group">
                    <label for="exampleInputEmail1">商品类型</label>
                    <select class="form-control" name='type_id' >
                        <option value="0">请选择</option>
                        @foreach($type as $v)
                        <option value="{{$v->id}}">{{$v->name}}</option>
                        @endforeach
                    </select>
                </div>
                <br>

                <table width="100%" id="attrTable" class='table table-bordered'>
                    <tr>
                        <td>前置摄像头</td>
                        <td>
                            <input type="hidden" name="attr_id_list[]" value="211">
                            <input name="attr_value_list[]" type="text" value="" size="20">
                            <input type="hidden" name="attr_price_list[]" value="0">
                        </td>
                    </tr>

                </table>
                <!-- <div class="form-group">
                        颜色:
                        <input type="text" name='attr_value_list[]'>
                </div> -->
                <!-- <div class="form-group" style='padding-left:26px'>
                    <a href="javascript:;">[+]</a>内存:
                    <input type="text" name='attr_value_list[]'>
                    属性价格:<input type="text" name='attr_price_list[][]'>
                </div> -->

            </div>

            <button type="submit" class="btn btn-default" id='btn'>添加</button>
        </form>

        <script type="text/javascript">
            //标签页 页面渲染
            $(".nav-tabs a").on("click",function(){
                $(this).parent().siblings('li').removeClass('active');
                $(this).parent().addClass('active');
                var name = $(this).attr('name');  // attr basic
                $(".div_form").hide();
                $(".div_"+name).show();  // $(".div_"+name)
            })
            $('[name="cat_id"]').on('change',function () {
                // alert(1);
                $('#attrTable tr').empty();
                var type_id = $(this).val();
                // alert(type_id);
                // if(type_id == 0){

                // }else{
                    $.ajax({
                        url : "{{url('app/admin/select_type1')}}",
                        data : {type_id:type_id},
                        dataType : 'json',
                        type : 'get',
                        success : function (res) {
                            $.each(res.msg,function(i,v){
                                if(v.xianshi == 2){
                                    var tr = '<tr>\
                                    <td><a href="javascript:;" id="hao">[+]</a>'+v.name+'</td>\
                                            <td>\
                                            <input type="hidden" name="attr_id_list[]" value="'+v.id+'">\
                                            <input name="attr_value_list[]" type="text" value="" size="20">\
                                            属性价格 <input type="text" name="attr_price_list[]" value="" size="5" maxlength="10">\
                                            </td>\
                                     </tr>';
                                    $('#attrTable').append(tr);
                                }else{
                                    var tr = '<tr>\
                                    <td>'+v.name+'</td>\
                                            <td>\
                                            <input type="hidden" name="attr_id_list[]" value="'+v.id+'">\
                                            <input name="attr_value_list[]" type="text" value="" size="20">\
                                            </td>\
                                     </tr>';
                                    $('#attrTable').append(tr);
                                }

                            })
                        }
                    })
                // }
            })
            $(document).on('click','#hao',function () {
                // alert(12);
                var name = $(this).html();
                if(name == '[+]'){
                    var name = $(this).html('[-]');
                    var tr_clone = $(this).parent().parent().clone();
                    // console.log(tr_clone);
                    $(this).parent().parent().after(tr_clone);
                    $(this).html('[+]');
                }else{
                    $(this).parent().parent().remove();
                }
                // alert(name);

            })
        </script>
    </center>
@endsection