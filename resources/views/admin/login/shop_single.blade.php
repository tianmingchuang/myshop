@extends('admin.layout.login')
@section('title','商品详情页')
@section('body')
    <!-- shop single -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="pages section">
        <div class="container">
            <div class="shop-single">
                <img src="{{$data->goods_pic}}" alt="">
                <h5>{{$data->goods_name}}</h5>
                <div class="price">{{$data->goods_price}} <span>$28</span></div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam eaque in non delectus, error iste veniam commodi mollitia, officia possimus, repellendus maiores doloribus provident. Itaque, ab perferendis nemo tempore! Accusamus</p>
                <form action="{{url('admin/login/cart_do')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <input type="submit" class="btn button-default" value="ADD TO CART">
{{--                    <button type="button" class="btn button-default">ADD TO CART</button>--}}
                </form>

{{--                <a href="{{url('admin/login/cart',['id'=>$data->id])}}" class="btn button-default">ADD TO CART</a>--}}
            </div>
{{--            <script>--}}
{{--                $.ajaxSetup({--}}
{{--                    headers: {--}}
{{--                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                        --}}
{{--                    }--}}
{{--                    --}}
{{--                });--}}
{{--            </script>--}}

            <div class="review">
                <h5>1 reviews</h5>
                <div class="review-details">
                    <div class="row">
                        <div class="col s3">
                            <img  src="{{asset('mstore/img/user-comment.jpg')}}" alt="" class="responsive-img">
                        </div>
                        <div class="col s9">
                            <div class="review-title">
                                <span><strong>John Doe</strong> | Juni 5, 2016 at 9:24 am | <a href="">Reply</a></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis accusantium corrupti asperiores et praesentium dolore.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review-form">
                <div class="review-head">
                    <h5>Post Review in Below</h5>
                    <p>Lorem ipsum dolor sit amet consectetur*</p>
                </div>
                <div class="row">
                    <form class="col s12 form-details">
                        <div class="input-field">
                            <input type="text" required class="validate" placeholder="NAME">
                        </div>
                        <div class="input-field">
                            <input type="email" class="validate" placeholder="EMAIL" required>
                        </div>
                        <div class="input-field">
                            <input type="text" class="validate" placeholder="SUBJECT" required>
                        </div>
                        <div class="input-field">
                            <textarea name="textarea-message" id="textarea1" cols="30" rows="10" class="materialize-textarea" class="validate" placeholder="YOUR REVIEW"></textarea>
                        </div>
                        <div class="form-button">
                            <div class="btn button-default">POST REVIEW</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection