@extends('layout')
@section('content')
@foreach($product_detail as $key => $value)
<div class="product-details"><!--product-details-->
						<style type="text/css">
							.ISSlideOuter .ISPager.ISGallery img{
								display: block;
								height: 140px;
								max-width: 100%;
							}
							li.active{
								border: 2px solid #00e600;
							}
						</style>
						<div class="col-sm-5">
								<ul id="imageGallery">
									@foreach($gallery as $key => $gal)
										  <li data-thumb="{{asset('upload/gallery/'.$gal->gallery_image) }}" data-src="{{asset('upload/gallery/'.$gal->gallery_image) }}">
										    <img width="100%" alt="{{ $gal->gallery_name }}" src="{{asset('upload/gallery/'.$gal->gallery_image) }}" />
										  </li>
									@endforeach

								  
								  
								</ul>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{ $value->product_name }}</h2>
								<p>Mã sản phẩm: {{ $value->product_id }}</p>
								<img src="images/product-details/rating.png" alt="" />
								


								<form action="{{ URL::to('/save-cart') }}" method="POST">
									@csrf
								
                                            <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                                            


								<span>
									<span>{{ number_format($value->product_price).' '.'VNĐ' }}</span>
									<label>Số lượng:</label>
									
									<input type="number" min="1" value="1" class="cart_product_qty_{{$value->product_id}}" />

									<button type="button" class="btn btn-default add-to-cart " data-id_product="{{$value->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
                                            </form>
								</span>
								</form>
								<p><b>Tình trạng:</b> Còn hàng</p>
								<p><b>Điều kiện:</b> Mới</p>
								<p><b>Thương hiệu: </b>{{ $value->brand_name }}</p>
								<p><b>Danh mục: </b>{{ $value->category_name }}</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Chi tết sản phẩm</a></li>
								<li ><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p>{{ $value->product_desc }}</p>
								
							</div>
							<!-- companyprofile -->
							<div class="tab-pane fade" id="companyprofile" >
								<p>{{ $value->product_content }}</p>
								
							</div>
							
							
							
							<div class="tab-pane fade " id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					@endforeach
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									@foreach($related as $key=> $lienquan)
									
									<a href="{{URL::to('/chi-tiec-san-pham/'.$lienquan->product_id)}}">
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">

                                        <div class="productinfo text-center">
                                            <form>
                                                @csrf
                                            <input type="hidden" value="{{$lienquan->product_id}}" class="cart_product_id_{{$lienquan->product_id}}">
                                            <input type="hidden" value="{{$lienquan->product_name}}" class="cart_product_name_{{$lienquan->product_id}}">
                                            <input type="hidden" value="{{$lienquan->product_image}}" class="cart_product_image_{{$lienquan->product_id}}">
                                            <input type="hidden" value="{{$lienquan->product_price}}" class="cart_product_price_{{$lienquan->product_id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$lienquan->product_id}}">

                                            <a href="{{URL::to('/chi-tiec-san-pham/'.$lienquan->product_id)}}">
                                                <img src="{{URL::to('upload/product/'.$lienquan->product_image)}}" alt="" />
                                                <h2>{{number_format($lienquan->product_price).' '.'VNĐ'}}</h2>
                                                <p>{{$lienquan->product_name}}</p>

                                             
                                             </a>
                                            <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$lienquan->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
                                            </form>

                                        </div>
                                        {{-- <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div> --}}
                                </div>
										</div>
									</div>
								</a>

									@endforeach
								</div>
								
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
@endsection