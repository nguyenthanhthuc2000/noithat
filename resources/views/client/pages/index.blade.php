@extends('client.layout')
@section('content')
	@include('config')
	@include('client.slider')
	@include('client.tieuchi')
		<!-- Start Most Popular -->

</select>
	<div class="product-area most-popular section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Sản phẩm mới</h2>
					</div>
				</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
						@foreach($getProms as $getProm)
							<div class="single-product">
								<div class="product-img">
									<a href="{{route('chi-tiet-san-pham.show',$getProm->slug)}}">
										@if($getProm->photo == '')
											<img class="default-img" src="{{IMG404}}" alt="{{$getProm->tenvi}}">
										@else
											<img class="default-img" src="{{IMGPRODUCTS.$getProm->photo}}" alt="{{$getProm->tenvi}}">
										@endif
										@if($getProm->moi=='1')
										<span class="new">Mới</span>
										@endif
									</a>
									<div class="button-head">
										<div class="product-action">
											<a title="Xem chi tiết" href="{{route('chi-tiet-san-pham.show',$getProm->slug)}}"><i class=" ti-eye"></i><span>Xem chi tiết</span></a>
											<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
										</div>
										<div class="product-action-2">
											<span> @if($getProm->soluong ==0) Hết hàng @else Còn {{$getProm->soluong }} sản phẩm @endif </span> 
										</div>
									</div>
								</div>
								<div class="product-content">
									<h3><a href="{{route('chi-tiet-san-pham.show',$getProm->slug)}}">{{$getProm->tenvi}}</a></h3>
									<div class="product-price">
										@if($getProm->price_pro == '0' && $getProm->price == '0')
											Giá <span style="color:#f00;" ><a href="tel:11">Liên hệ</a></span>
										@elseif($getProm->price_pro == '0')
	                                    	Giá <span style="color:#f00;">{{number_format($getProm->price,'0',',','.')}}đ</span>
	                                    @else 
		                                   Giá <span style="color:#f00;">{{number_format($getProm->price_pro,'0',',','.')}}đ</span> 
		                                    <span class="old">{{number_format($getProm->price,'0',',','.')}}đ</span>
	                                    @endif
									</div>
									<div class="product-action-2">
										<form>
                                            @csrf
                                            <input type="hidden" name="" value="1" class="cart_product_qty_{{$getProm->id}}">
											<button type="button"title="Add to cart" data-id="{{$getProm->id}}" data-sl="{{$getProm->soluong}}" data-price="{{$getProm->price}}" class="add-cart btn-add-cart">Thêm giỏ hàng</button>
										</form>
										</div>
								</div>
							</div>
						@endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End Most Popular Area -->
	<!-- Start Product Area -->
    <div class="product-area section">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Sản phẩm bán chạy</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="product-info">
							<div class="nav-main">
								<!-- Tab Nav -->
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									<?php $i = 0; ?>
									@foreach($getCatNbs as $getCatNb)
									<?php $i++; ?>
									 <!-- active -->
									<li class="nav-item"><a class="nav-link @if($i==1) active @endif" data-toggle="tab" href="#nb{{$getCatNb->id}}" role="tab">{{$getCatNb->tenvi}}</a></li>
									@endforeach
								</ul>
								<!--/ End Tab Nav -->
							</div>
							<div class="tab-content" id="myTabContent">
								<!-- Start Single Tab -->
								<?php $j = 0; ?>
								@foreach($getCatNbs as $getCatNb)
								<?php $j++; ?>
									<div class="tab-pane fade show  @if($j==1) active @endif" id="nb{{$getCatNb->id}}" role="tabpanel">
									<div class="tab-single">
									<div class="row">
										<?php $max8 = 8; ?>
									@foreach($getProbcbyCatNbs as $getProbcbyCatNb)
										@if($getCatNb->id == $getProbcbyCatNb->id_cat && $max8 > 0)

											<div class="col-xl-3 col-md-4 col-sm-6 col-12">
												<div class="single-product">
													<div class="product-img">
														<a href="{{route('chi-tiet-san-pham.show',$getProbcbyCatNb->slug)}}">
															@if($getProbcbyCatNb->photo == '')
																<img class="default-img" src="{{IMG404}}" alt="#">
															@else
																<img class="default-img" src="{{IMGPRODUCTS.$getProbcbyCatNb->photo}}" alt="#">
															@endif
															@if($getProbcbyCatNb->banchay=='1')
															<span class="price-dec">Bán chạy</span>
															@endif
														</a>
														<div class="button-head">
															<div class="product-action">
																<a title="Xem chi tiết" href="{{route('chi-tiet-san-pham.show',$getProbcbyCatNb->slug)}}"><i class=" ti-eye"></i><span>Xem chi tiết</span></a>
																<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
															</div>
															<div class="product-action-2">
																<span> @if($getProbcbyCatNb->soluong ==0) Hết hàng @else Còn {{$getProbcbyCatNb->soluong }} sản phẩm @endif </span> 
															</div>
														</div>
													</div>
													<div class="product-content">
														<h3><a href="{{route('chi-tiet-san-pham.show',$getProbcbyCatNb->slug)}}">{{$getProbcbyCatNb->tenvi}}</a></h3>
														<div class="product-price">
															@if($getProbcbyCatNb->price_pro == '0' && $getProbcbyCatNb->price == '0')
																Giá <span style="color:#f00;" ><a href="tel:11">Liên hệ</a></span>
															@elseif($getProbcbyCatNb->price_pro == '0')
						                                    	Giá <span style="color:#f00;">{{number_format($getProbcbyCatNb->price,'0',',','.')}}đ</span>
						                                    @else 
							                                   Giá <span style="color:#f00;">{{number_format($getProbcbyCatNb->price_pro,'0',',','.')}}đ</span> 
							                                    <span class="old">{{number_format($getProbcbyCatNb->price,'0',',','.')}}đ</span>
						                                    @endif
														</div>
														<div class="product-action-2">
															<form>
					                                            @csrf
					                                            <input type="hidden" name="" value="1" class="cart_product_qty_{{$getProbcbyCatNb->id}}">
																<button type="button"title="Add to cart" data-id="{{$getProbcbyCatNb->id}}" data-sl="{{$getProbcbyCatNb->soluong}}" class="add-cart btn-add-cart">Thêm giỏ hàng</button>
															</form>
														</div>
													</div>
												</div>
											</div>
											<?php $max8--; ?>
										@endif
									@endforeach
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
            </div>
    </div>
	<!-- End Product Area -->
	

	
	<!-- Start Most Popular -->
	<div class="product-area most-popular section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Sản phẩm nổi bật</h2>
					</div>
				</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
						@foreach($getPronbs as $getPronb)
							<div class="single-product">
								<div class="product-img">
									<a href="{{route('chi-tiet-san-pham.show',$getPronb->slug)}}">
										@if($getPronb->photo == '')
											<img class="default-img" src="{{IMG404}}" alt="#">
										@else
											<img class="default-img" src="{{IMGPRODUCTS.$getPronb->photo}}" alt="#">
										@endif
										@if($getPronb->noibat=='1')
										<span class="out-of-stock">Hot</span>
										@endif
									</a>
									<div class="button-head">
										<div class="product-action">
											<a  title="Xem chi tiết" href="{{route('chi-tiet-san-pham.show',$getPronb->slug)}}"><i class=" ti-eye"></i><span>Xem chi tiết</span></a>
											<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
										</div>
										<div class="product-action-2">
											<span> @if($getPronb->soluong ==0) Hết hàng @else Còn {{$getPronb->soluong }} sản phẩm @endif </span> 
										</div>
									</div>
								</div>
								<div class="product-content">
									<h3><a href="{{route('chi-tiet-san-pham.show',$getPronb->slug)}}">{{$getPronb->tenvi}}</a></h3>
									<div class="product-price">
										@if($getPronb->price_pro == '0' && $getPronb->price == '0')
											Giá <span style="color:#f00;" ><a href="tel:11">Liên hệ</a></span>
										@elseif($getPronb->price_pro == '0')
	                                    	Giá <span style="color:#f00;">{{number_format($getPronb->price,'0',',','.')}}đ</span>
	                                    @else 
		                                   Giá <span style="color:#f00;">{{number_format($getPronb->price_pro,'0',',','.')}}đ</span> 
		                                    <span class="old">{{number_format($getPronb->price,'0',',','.')}}đ</span>
	                                    @endif
									</div>
									<div class="product-action-2">
											<form>
	                                            @csrf
	                                            <input type="hidden" name="" value="1" class="cart_product_qty_{{$getPronb->id}}">
												<button type="button"title="Add to cart" data-id="{{$getPronb->id}}" data-sl="{{$getPronb->soluong}}" class="add-cart btn-add-cart">Thêm giỏ hàng</button>
											</form>
										</div>
								</div>
							</div>
						@endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End Most Popular Area -->
	
	<section class="section banner">
    		<img src="{{URL::to(IMGPHOTOS.$banner->photo)}}">
    </section>
	
	
	<!-- Start Shop Blog  -->
	@if($baiviets->count() > 0)
	<section class="shop-blog section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Bài viết</h2>
					</div>
				</div>
			</div>
			<div class="slick-bai-viet">
				@foreach($baiviets as $key => $baiviet)
					<div class="bai-viet">
						<!-- Start Single Blog  -->
						<div class="shop-single-blog">
							<a href="{{route('chi-tiet-bai-viet.show',$baiviet->slug)}}">
								@if($getPronb->photo == '')
									<img class="height367" src="{{IMG404}}" alt="{{$baiviet->tenvi}}">
								@else
									<img class="height367" src="{{IMGBLOG.$baiviet->photo}}" alt="{{$baiviet->tenvi}}">
								@endif
							<div class="content">
								<p class="date">Đăng ngày {{date_format($baiviet->created_at,"d-m-Y")}}</p>
								<!-- <p class="date"><?php echo date("jS F, Y", strtotime("$baiviet->created_at"));?></p> -->
								<a href="{{route('chi-tiet-bai-viet.show',$baiviet->slug)}}" class="title">{{$baiviet->tenvi}}</a>
								<a href="{{route('chi-tiet-bai-viet.show',$baiviet->slug)}}" class="more-btn">Xem thêm</a>
							</div>
						</div>
						<!-- End Single Blog  -->
					</div>
				@endforeach
			</div>
		</div>
	</section>
	@endif
	<!-- End Shop Blog  -->
	<!-- Album -->
	<section class="box-album section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Album</h2>
					</div>
				</div>
				<div class="album">
					@foreach($albums as $album)
						<div class="album-img">
							<a href="{{$album->link}}">
								<img class="" src="{{IMGPHOTOS.$album->photo}}" alt="{{$album->tenvi}}">
							</a>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>
	<!-- end album -->
	<!-- Start Shop Services Area -->
	<section class="shop-services section home">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free shiping</h4>
						<p>Orders over $100</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Free Return</h4>
						<p>Within 30 days returns</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Sucure Payment</h4>
						<p>100% secure payment</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Best Peice</h4>
						<p>Guaranteed price</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Services Area -->
	
	<!-- Start Shop Newsletter  -->
	<section class="shop-newsletter section">
		<div class="container">
			<div class="inner-top">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-12">
						<!-- Start Newsletter Inner -->
						<div class="inner">
							<h4>Newsletter</h4>
							<p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
							<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
								<input name="EMAIL" placeholder="Your email address" required="" type="email">
								<button class="btn">Subscribe</button>
							</form>
						</div>
						<!-- End Newsletter Inner -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Newsletter -->
	
	<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row no-gutters">
							<div class="col-lg-6 offset-lg-3 col-12">
								<h4 style="margin-top:100px;font-size:14px; font-weight:600; color:#F7941D; display:block; margin-bottom:5px;">Eshop Free Lite</h4>
								<h3 style="font-size:30px;color:#333;">Currently You are using free lite Version of Eshop.<h3>
								<p style="display:block; margin-top:20px; color:#888; font-size:14px; font-weight:400;">Please, purchase full version of the template to get all pages, features and commercial license</p>
								<div class="button" style="margin-top:30px;">
									<a href="https://wpthemesgrid.com/downloads/eshop-ecommerce-html5-template/" target="_blank" class="btn" style="color:#fff;">Buy Now!</a>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- Modal end -->
@endsection