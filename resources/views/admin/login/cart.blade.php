@extends('admin.layout.login')
@section('title','购物车')
@section('body')
    <form action="{{url('pay')}}" method="post">
    <div class="cart section">
        <div class="container">
            <div class="pages-head">
                <h3>CART</h3>
            </div>

            <div class="content">
    @csrf
                @foreach ($data as $v)
                <div class="cart-2">
                    <div class="row">
                        <div class="col s5">
                            <h5>Image</h5>
                        </div>
                        <div class="col s7">
                            <img src="{{$v->goods_pic}}" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Name</h5>
                        </div>
                        <div class="col s7">
                            <h5><a href="">{{$v->goods_name}}</a></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Quantity</h5>
                        </div>
                        <div class="col s7">
                            <input value="{{$v->shuliang}}" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Price</h5>
                        </div>
                        <div class="col s7">
                            <h5>${{$v->goods_price}}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>total price</h5>
                        </div>
                        <div class="col s7">
                            <h5>${{$jiage}}</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s5">
                            <h5>Action</h5>
                        </div>
                        <div class="col s7">
                            <h5><i class="fa fa-trash"></i></h5>
                        </div>
                    </div>

{{--                    {{$v->goods_id}}--}}
{{--                    <input type="hidden" name="id" id="{{$v->goods_id}}">--}}
                @endforeach
            </div>
            <div class="total">
                <div class="row">
                    <div class="col s7">
                        <h5>Fashion Men's</h5>
                    </div>
                    <div class="col s5">
                        <h5>$21.00</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col s7">
                        <h5>Fashion Men's</h5>
                    </div>
                    <div class="col s5">
                        <h5>$20.00</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col s7">
                        <h6>Total</h6>
                    </div>
                    <div class="col s5">
                        <h6>${{$jiages}}</h6>
                    </div>
                </div>
            </div>
            <button class="btn button-default">Process to Checkout</button>
        </div>
    </div>
    </form>
@endsection