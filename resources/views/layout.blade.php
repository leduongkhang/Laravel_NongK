<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- seo --}}
   {{--  <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <meta name="description" content="{{ $meta_desc }}">
    <meta name="author" content="">
     <link  rel="canonical" href="{{ $url_canonical }}" />
     <link  rel="icon" type="image/x-icon" href="" /> --}}


    {{-- <title>{{ $meta_title }}</title> --}}
    <title>Bán sản phẩm thuốc bảo vệ thực vật</title>
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/sweetalert.css')}}" rel="stylesheet">

    <link href="{{asset('frontend/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettify.css')}}" rel="stylesheet">

    

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{('frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="tel:+84941837191" alt=""><i class="fa fa-phone" class="btn btn-success"></i> +84 94 18 37 191</a></li>
                                <li><a href="https://mail.google.com/mail/"><i class="fa fa-envelope"></i> Khang_dth215947@student.agu.edu.vn</a></li>
                                <li><a href="/shopnongduoclaravel/admin"><i class="fa fa-star"></i> Admin Quản lý</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="https://www.facebook.com/kusaisme/"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://x.com/?lang=vi"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/accounts/login/"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="https://dribbble.com/"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="https://www.google.com/"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{ URL::to('/') }}"><img src="{{('frontend/imagess/logo.png')}}" alt="" /></a>
                        </div>
                        
                    </div>
                    <div class="col-sm-8" >
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                
                                <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if($customer_id!=NULL && $shipping_id==NULL){
                                ?>
                                    <li>
                                    @if(Session::get('customer_id'))
                                        <a href="{{ URL::to('/checkout') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a>
                                    @else
                                        <a href="{{ URL::to('/login-checkout') }}" >
                                            <i class="fa fa-crosshairs"></i> Thanh toán
                                        </a>
                                    @endif
                                </li>
                                <?php
                            }elseif($customer_id!=NULL && $shipping_id!=NULL){
                                ?>
                                <li><a href="{{ URL::to('/payment') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                            }else{
                                ?>
                                    <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                            }
                                ?>
                                

                                <li><a href="{{ URL::to('/gio-hang') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id!=NULL){
                                ?>
                                    <li><a href="{{ URL::to('/logout-checkout') }}"><i class="fa fa-lock"></i> Đăng xuât</a></li>
                                <?php
                            }else{
                                ?>
                                    <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                <?php
                            }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" style="color: #00e600;">Trang chủ</a></li>
                                <li class="dropdown"><a >Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category->sortBy(fn($b) => strlen($b->category_name)) as $key => $cate)
                                        <li><a href="{{ URL::to('/danh-muc-san-pham/'.$cate->category_id) }}">{{ $cate->category_name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                    
                                </li> 
                                <li><a href="{{ URL::to('/gio-hang') }}">Giỏ hàng</a></li>
                                <li><a href="{{ URL::to('/all-product-customer') }}">Tất cả sản phẩm</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{ URL::to('/tim-kiem') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="search_box pull-right">
                                <input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm"/>
                                <input type="submit" style="margin-top:0px; color:black; background-color: #00e600
; border: 1px solid #007bff;" class="btn btn-sm" value="Tìm kiếm" name="search_items" />
                            </div>
                    </form>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            @php
                                $i=0;
                            @endphp
                            @foreach($slider as $key => $slide)
                            @php
                                $i++;
                            @endphp
                            <div class="item {{ $i==1 ? 'active' : '' }}">
                                
                                <div style="text-align: center;">
                                    <img alt="{{ $slide->slider_desc }}" 
                                         src="{{ asset('upload/slider/'.$slide->slider_image) }}" 
                                         style="max-width: 100%; height: 200px; object-fit: cover; display: inline-block;" 
                                         class="img img-responsive">
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <section >
        <div class="container">
            <div class="row ">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục sản phẩm</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @foreach($category->sortBy(fn($b) => strlen($b->category_name)) as $key => $cate)
                            
                            
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{ URL::to('/danh-muc-san-pham/'.$cate->category_id) }}">{{ $cate->category_name }}</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu sản phẩm</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    {{-- sap xep --}}
                                    @foreach($brand->sortBy(fn($b) => strlen($b->brand_name)) as $key => $brand) 
                                    <li><a href="{{ URL::to('/thuong-hieu-san-pham/'.$brand->brand_id) }}"> <span class="pull-right"> </span>{{ $brand->brand_name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        
                        
                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                @yield('content')

                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        <div class="container">
                    <div class="row">
                        
                        <div class="col-md-6 col-sm-12 col-xs-12 widget-footer">
                            <h4 class="title-footer">Chủ sở hữu website: </h4>
                            <div class="content-footer block-collapse row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p>Công ty TNHH đầu tư - thương mại Mộc Điền:
                                        Giấy chứng nhận đăng ký kinh doanh số: 1111111.  
                                        Nơi cấp: Sở kế hoạch và đầu tư Thành Phố Hồ Chí Minh  Phòng đăng ký kinh doanh. 

                                        Giấy chứng nhận đăng ký địa điểm kinh doanh số: 0314089337- 00003
                                        Tên địa điểm kinh doanh: Địa điểm kinh doanh công ty TNHH đầu tư - thương mại Mộc Điền.
                                    </p>
                                    
                                    <div class="logo-footer hidden-xs">
                                        <a href="http://online.gov.vn/Home/WebDetails/126751" target="_blank" rel="noreferrer">
                                            <img style="width: 60%; height: 60%;" class=" lazyloaded" data-src="//theme.hstatic.net/200000708159/1001044176/14/footer_logobct_img.png?v=298" src="//theme.hstatic.net/200000708159/1001044176/14/footer_logobct_img.png?v=298" alt="Bộ Công Thương">
                                        </a>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="address-footer">
                                        <ul>
                                        <li class="contact-1"><b>Địa chỉ:</b> 
                                        68 Đường N2, P Bình Khánh, Tp Long Xuyên, An Giang
                                        <b>Địa chỉ địa điểm kinh doanh:</b> 
                                        Khu vực đồng bằng sông cửu long.

                                        </li><li class="contact-2"><b>Điện thoại:</b> 0941837191</li><li class="contact-3"><b>Thông tin người nộp thuế:</b> </li><li class="contact-4"><b>Giấy chứng nhận đủ điều kiện buôn bán thuốc bảo vệ thực vật :<b>  Giấy chứng nhận đủ điều kiện buôn bán phân bón:</b>  Số: </b></li><b>                                        </b></ul><b>
                                    </b></div><b>
                                    
                                    <div class="logo-footer visible-xs">
                                        <a href="http://online.gov.vn/Home/WebDetails/126751" target="_blank" rel="noreferrer">
                                            <img class="lazyload" data-src="//theme.hstatic.net/200000708159/1001044176/14/footer_logobct_img.png?v=298" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" alt="Bộ Công Thương">
                                        </a>
                                    </div>
                                    
                                </b></div><b>
                            </b></div><b>
                        </b></div><b>
                        
                        
                                                
                        <div class="col-md-3 col-sm-12 col-xs-12 widget-footer">    

                            <h4 class="title-footer">Chăm sóc khách hàng</h4>
                            <div >
                                <div >
                                    
                                    
                                    <li><a href="tel:+84941837191" alt=""><i class="fa fa-phone" class="btn btn-success"></i> +84 94 18 37 191</a></li>
                                    <li><a href="https://mail.google.com/mail/"><i class="fa fa-envelope"></i> Khang_dth215947@student.agu.edu.vn</a></li>
                                    
                                </div>
                                

                                

                                <ul class="footerNav-social">                                           
                             </ul>
                            </div>


                        </div>
                        
                    </b></div><b>
                </b></div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2025 NÔNG K Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="https://www.facebook.com/kusaisme/">KHANG DUONG LE</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    
    <script src="{{asset('frontend/js/jquery.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
    
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    
    <script src="{{asset('frontend/js/price-range.js')}}"></script>
    
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <script src="{{asset('frontend/js/sweetalert.min.js')}}"></script>
    
    <script src="{{asset('frontend/js/lightslider.js')}}"></script>
    <script src="{{asset('frontend/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('frontend/js/prettify.js')}}"></script>

    <script type="text/javascript">
         $(document).ready(function() {
        $('#imageGallery').lightSlider({
            gallery:true,
            item:1,
            loop:true,
            thumbItem:3,
            slideMargin:0,
            enableDrag: false,
            currentPagerPosition:'left',
            onSliderLoad: function(el) {
                el.lightGallery({
                    selector: '#imageGallery .lslide'
                });
            }

        });  
      });

    </script>

    {{-- <script type="text/javascript">
        $(document).ready(function(){
            $('.send_order').click(function(){

                swal({
                  title: "Xác nhận đơn hàng",
                  text: "Đơn hàng sẽ không được hoàng trả khi đặt, bạn có chắc?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Xác nhận mua hàng",
                  cancelButtonText: "Mua thêm",
                  closeOnConfirm: false,
                  closeOnCancel: false
                },

                function(isConfirm) {
                  if (isConfirm) {
                    
                    var shipping_email = $('.shipping_email').val();
                var shipping_name = $('.shipping_name' ).val();
                var shipping_address = $('.shipping_address' ).val();
                var shipping_phone = $('.shipping_phone' ).val();
                var shipping_notes = $('.shipping_notes' ).val();
                var shipping_method = $('.payment_select' ).val();
                var order_fee = $('.order_fee' ).val();

                var order_coupon = $('.order_coupon').val();
                    if (typeof order_coupon === "undefined" || order_coupon === "") {
                        order_coupon = "no";
                    }

                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/confirm-order')}}',
                    method: 'POST',
                    data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,_token:_token,order_fee:order_fee,order_coupon:order_coupon,shipping_method:shipping_method},
                    success:function(){

                        swal("Đơn hàng", "Đơn hàng của bạn đã được gửi đi", "success");

                    }

                });
                window.setTimeout(function(){
                    location.reload();
                }, 3000);
                  } else {
                    swal("Đóng", "Đơn hàng chưa được gửi, vui lòng hoàng tất đơn hàng", "error");
                  }
                });
                
                
            });
        });
    </script> --}}
    
<script type="text/javascript">
    $(document).ready(function(){
        $('.send_order').click(function(){
            var shipping_email = $('.shipping_email').val();
            var shipping_name = $('.shipping_name').val();
            var shipping_address = $('.shipping_address').val();
            var shipping_phone = $('.shipping_phone').val();
            var shipping_notes = $('.shipping_notes').val();
            var shipping_method = $('.payment_select').val();
            var order_fee = $('.order_fee').val();
            var order_coupon = $('.order_coupon').val();
            var _token = $('input[name="_token"]').val();

            if(shipping_email === '' || shipping_name === '' || shipping_address === '' || shipping_phone === ''){
                swal("Thiếu thông tin", "Vui lòng điền đầy đủ các trường bắt buộc!", "error");
                return false;
            }

            swal({
                title: "Xác nhận đơn hàng",
                text: "Đơn hàng sẽ không được hoàn trả khi đặt, bạn có chắc?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Xác nhận mua hàng",
                cancelButtonText: "Mua thêm",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if(isConfirm){
                    $.ajax({
                        url: '{{url('/confirm-order')}}',
                        method: 'POST',
                        data:{
                            shipping_email:shipping_email,
                            shipping_name:shipping_name,
                            shipping_address:shipping_address,
                            shipping_phone:shipping_phone,
                            shipping_notes:shipping_notes,
                            _token:_token,
                            order_fee:order_fee,
                            order_coupon:order_coupon,
                            shipping_method:shipping_method
                        },
                        success:function(){
                            swal("Đơn hàng", "Đơn hàng của bạn đã được gửi đi", "success");
                            setTimeout(function(){ location.reload(); }, 3000);
                        }
                    });
                } else {
                    swal("Đóng", "Đơn hàng chưa được gửi, vui lòng hoàn tất đơn hàng", "error");
                }
            });
        });
    });
</script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                if(parseInt(cart_product_qty)>=parseInt(cart_product_quantity)){
                    alert('Vui lòng đặt nhỏ hơn ' + cart_product_quantity);
                }else{
                    $.ajax({
                        url: '{{url('/add-cart-ajax')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                        success:function(){

                            swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{url('/gio-hang')}}";
                                });

                        }

                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            // alert(action);
            //  alert(matp);
            //   alert(_token);

            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        }); 
        });
         
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.calculate_delivery').click(function(){
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if(matp == '' && maqh ==''&& xaid ==''){
                    alert('Vui lòng chọn địa chỉ để tính phí vận chuyển!!');
                }else{
                $.ajax({
                url : '{{url('/calculate-fee')}}',
                method: 'POST',
                data:{matp:matp,maqh:maqh,_token:_token,xaid:xaid},
                success:function(){
                   location.reload();    
                        }  
                    });
                     }
                });
            });
    </script>
    
</body>
</html>