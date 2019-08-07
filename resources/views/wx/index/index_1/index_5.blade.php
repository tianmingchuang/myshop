@extends('index.layout.login')
@section('title','微信上传素材')
@section('body')
    <center>
        <form action="{{url('wx/index/index_1/index_5_do')}}" method="post" enctype="multipart/form-data">
           上传素材文件类型:  <select name="up_type" id="">
                <option value="1">临时</option>
                <option value="2">永久</option>
            </select>
            <br><br>
            @csrf
            <span>图片</span>
            文件：<input type="file" name="image" value=""><br/><br/>
            <span>语音</span>
            文件：<input type="file" name="voice" value=""><br/><br/>
            <span>视频</span>
            文件：<input type="file" name="video" value=""><br/><br/>
            <span>缩略图</span>
            文件：<input type="file" name="thumb" value=""><br/><br/>
            <input type="submit" name="" value="提交">
        </form>
    </center>
@endsection
