<div class="col-sm-12 clearfix">
    <div class="table-responsive cart_info">
        <form action="{{ url('/update-cart') }}" method="POST">
            @csrf
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Giá sản phẩm</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Thành tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @if(Session::get('cart'))
                        @php $total = 0; @endphp
                        @foreach(Session::get('cart') as $key => $cart)
                            @php
                                $subtotal = $cart['product_price'] * $cart['product_qty'];
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td class="cart_product">
                                    <img src="{{ asset('public/upload/product/'.$cart['product_image']) }}" width="90" alt="{{ $cart['product_name'] }}" />
                                </td>
                                <td class="cart_description">
                                    <p>{{ $cart['product_name'] }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{ number_format($cart['product_price'], 0, ',', '.') }}đ</p>
                                </td>
                                <td class="cart_quantity">
                                    <input class="cart_quantity_" type="number" min="1" name="cart_qty[{{ $cart['session_id'] }}]" value="{{ $cart['product_qty'] }}">
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">{{ number_format($subtotal, 0, ',', '.') }}đ</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="{{ url('/del-product/'.$cart['session_id']) }}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default btn-sm"></td>
                            <td><a class="btn btn-default check_out" href="{{ url('/del-all-product') }}">Xóa tất cả sản phẩm</a></td>
                            <td>
                                @if(Session::get('coupon'))
                                    <a class="btn btn-default check_out" href="{{ url('/unset-coupon') }}">Xóa mã</a>
                                @endif
                            </td>
                            <td colspan="3">
                                <ul>
                                    <li>Tổng tiền: <span>{{ number_format($total, 0, ',', '.') }} Đ</span></li>
                                    @php $total_after = $total; @endphp
                                    @if(Session::get('coupon'))
                                        @foreach(Session::get('coupon') as $cou)
                                            @if($cou['coupon_condition'] == 1)
                                                <li>Mã giảm: {{ $cou['coupon_number'] }}%</li>
                                                @php
                                                    $total_coupon = ($total * $cou['coupon_number']) / 100;
                                                    $total_after = $total - $total_coupon;
                                                @endphp
                                            @elseif($cou['coupon_condition'] == 2)
                                                <li>Mã giảm: {{ number_format($cou['coupon_number'], 0, ',', '.') }}đ</li>
                                                @php
                                                    $total_after = $total - $cou['coupon_number'];
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endif

                                    @if(Session::get('fee'))
                                        <li>
                                            Phí vận chuyển: <span>{{ number_format(Session::get('fee'), 0, ',', '.') }} Đ</span>
                                            <a class="cart_quantity_delete" href="{{ url('/del-fee/') }}"><i class="fa fa-times"></i></a>
                                        </li>
                                        @php $total_after += Session::get('fee'); @endphp
                                    @endif

                                    <li>Tổng còn: <span>{{ number_format($total_after, 0, ',', '.') }} Đ</span></li>
                                </ul>
                            </td>
                        </tr>
                    @else
                        <tr><td colspan="6"><center>Hãy thêm sản phẩm vào giỏ hàng</center></td></tr>
                    @endif
                </tbody>
            </table>
        </form>

        @if(Session::get('cart'))
            <form method="POST" action="{{ url('/check-coupon') }}">
                @csrf
                <input type="text" name="coupon" class="form-control" placeholder="Nhập mã giảm giá"><br>
                <input type="submit" name="check_coupon" class="btn btn-default check_coupon" value="Tính mã giảm giá">
            </form>
        @endif
    </div>
</div>
