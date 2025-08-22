@extends('layout')
@section('content')

<section id="cart_items">
    <div class="fotter">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/trang-chu') }}">Trang chủ</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger">{{ session()->get('error') }}</div>
        @endif

        <div class="shopper-informations">
            <div class="row">
            	@include('pages.checkout.cart_view') {{-- tách phần giỏ hàng thành include để gọn hơn --}}
                <div class="col-sm-15 clearfix">
                    <div class="bill-to">
                        <p>Điền thông tin gửi hàng</p>
                        <div class="form-one">
                        	<form>
                                @csrf
                                <div class="form-group">
                                    <label>Chọn thành phố</label>
                                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                        <option value="">--Chọn tỉnh thành phố--</option>
                                        @foreach($city as $key => $ci)
                                            <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Chọn quận huyện</label>
                                    <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                        <option value="">--Chọn quận huyện--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Chọn xã phường</label>
                                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                        <option value="">--Chọn xã phường--</option>
                                    </select>
                                </div>
                                <input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery">
                            </form>
                            <form method="POST">
                                @csrf
                                <input type="text" name="shipping_email" class="shipping_email" placeholder="Email*">
                                <input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên">
                                <input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ">
                                <input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại">
                                <textarea name="shipping_notes" class="shipping_notes" placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea>

                                <input type="hidden" name="order_fee" class="order_fee" value="{{ Session::get('fee', 10000) }}">
                                @if(Session::get('coupon'))
                                    @foreach(Session::get('coupon') as $key => $cou)
                                        <input type="hidden" name="order_coupon" class="order_coupon" value="{{ $cou['coupon_code'] }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                                @endif

                                <div class="form-group">
                                    <label for="payment_select">Chọn hình thức thanh toán</label>
                                    <select name="payment_select" class="form-control input-sm m-bot15 payment_select">
                                        <option value="0">Qua chuyển khoản</option>
                                        <option value="1">Tiền mặt</option>
                                    </select>
                                </div>
                                <input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-sm send_order">
                            </form>

                            
                        </div>
                    </div>
                </div>

                

            </div>
        </div>
    </div>
</section>



@endsection
