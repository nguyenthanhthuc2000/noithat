@extends('client.layout')
@section('content')
	@include('config')	
		
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="blog-single.html">Cart</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
			
	<!-- Shopping Cart -->
	<div class=" cart-main section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					@if(Session::get('message'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>{{Session::get('message')}}</strong> 
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					  {{session::forget('message')}}
					</div>
					@endif
					@if(Session::get('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						  <strong>{{Session::get('success')}}</strong> 
						  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						  {{session::forget('success')}}
						</div>
						@endif
					<!-- Shopping Summery -->
					@if(Session::get('carts') == true )
					<form method="POST" action="{{route('shop.update_cart')}}">
						@csrf
					<div class="table-responsive">
						<table class="table cart-table">
						<thead>
							<tr class="main-hading">
								<th>Hình ảnh</th>
								<th class="min-w-300">Tên SP</th>
								<th>Giá SP VNĐ</th>
								<th>Giá KM VNĐ</th>
								<th class="text-center">Số Lượng</th>
								<th class="text-center">Tổng VNĐ</th>
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody>
							
							 <?php $Subtotal = 0; ?>
							 @foreach(Session::get('carts') as $key => $cart)
							<tr>
								<td ><img src="{{URL::to(IMGPRODUCTS.$cart['product_photo'])}}" alt="#"></td>
								<td class="min-w-300">
									<p class="product-name"><a href="#">{{$cart['product_name']}}</a></p>
									<p class="product-des">Đẳng cấp vip pro</p>
								</td>
								<td class="price @if($cart['product_price_pro'] > 0)  price_old @endif"><span>
								{{number_format($cart['product_price'],0,',','.')}} </span></td>
								<td class="price" data-title="Price"><span>
								@if($cart['product_price_pro'] === 0 ) 
								---
								@else
								{{number_format($cart['product_price_pro'],0,',','.')}}  </span></td>
								@endif
								<td class="qty"><!-- Input Order -->
									<div class="input-group">
										<div class="button minus">
											<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus"  data-field="qty[{{$cart['session_id']}}]">
												<i class="ti-minus"></i>
											</button>
										</div>
										<input type="text" name="qty[{{$cart['session_id']}}]" class="input-number"  data-min="1" data-max="100"  value="{{$cart['product_qty']}}">
										<div class="button plus">
											<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="qty[{{$cart['session_id']}}]">
												<i class="ti-plus"></i>
											</button>
										</div>
									</div>
									<!--/ End Input Order -->
								</td>
								<td class="total-amount"><span>
								@if($cart['product_price_pro'] == 0)
								<?php $total = $cart['product_price']*$cart['product_qty']; ?>
								{{number_format($total,0,',','.')}}
								@else
								<?php $total = $cart['product_price_pro']*$cart['product_qty']; ?>
								{{number_format($total,0,',','.')}} 
								@endif
								<?php $Subtotal += $total; ?>
								</span></td>
									<td class="action"><button type="button" class="del-product btn__style" data-session="{{$cart['session_id']}}"><i class="ti-trash remove-icon"></i></button></td>
							</tr>
							@endforeach
						</tbody>
						</table>
					</div>
						<button class="btn" style="float: right;" >Cập nhật</button>
						</form>
					@else
					<h3>Không tìm thấy sản phẩm trong giỏ hàng cùa bạn, <a href="{{route('shop.index')}}">click để mua hàng ngay !</a></h3>
					@endif
					<!--/ End Shopping Summery -->
				</div>
			</div>
			@if(Session::get('carts') == true )
			<div class="row">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="left">
									<div class="coupon">
										<form action="{{route('shop.apply_coupon')}}" method="POST" >
											@csrf
											<input name="coupon" placeholder="Mã giảm giá">
											@if(session::get('coupon_session') == true)
											<a class="btn" href="{{route('shop.destroy_coupon')}}">Hủy</a>
											@else
											<button class="btn " >Thêm</button>
											@endif
											
										</form>
										<br>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="right"><?php  ?>
									<ul>
										<li>Tổng giỏ hàng<span>{{number_format($Subtotal,0,',','.')}} VNĐ</span></li>
										<li>Phí giao hàng<span>Miễn phí</span></li>
										<li>Thuế 5%<span><?php $tax = ($Subtotal/100)*5;  ?>
										+ {{number_format($tax,0,',','.')}} VNĐ</span></li>
										@if(session::get('coupon_session') == true)
											@foreach(session::get('coupon_session') as $key => $cou)
												@if($cou['coupon_type'] == "sotien")
													<li>Mã giảm ({{$cou["coupon_code"]}})<span>
													<?php $coupon_money=$cou["coupon_number"] ?> - {{number_format($coupon_money,0,',','.')}} VNĐ</span></li>
												@else
													<?php $coupon_money=($Subtotal/100)*$cou["coupon_number"]?>
													<li>Mã giảm {{$cou["coupon_number"]}}% ({{$cou["coupon_code"]}})<span>- {{number_format($coupon_money,0,',','.')}} VNĐ</span></li>
												@endif
											@endforeach
										@endif
										@if(session::get('coupon_session') == true)
										<li class="last">Tổng cộng<span>{{number_format(($Subtotal+$tax) - $coupon_money,0,',','.')}} VNĐ</span></li>
										@else
										<li class="last">Tổng cộng<span>{{number_format($Subtotal+$tax,0,',','.')}} VNĐ</span></li>
										@endif
									</ul>
									<div class="button5">
										@if(session::get('user_name') == true)
										<a href="{{route('shop.checkout')}}" class="btn">Thanh toán</a>
										@else
										<a href="{{route('shop.viewlogin')}}" class="btn">Thanh toán</a>
										@endif
										<a href="{{route('shop.index')}}" class="btn">Tiếp tục mua hàng</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ End Total Amount -->
				</div>
			</div>
			@endif
		</div>
	</div>
	<!--/ End Shopping Cart -->
			
	<!-- Start Shop Services Area  -->
	<section class="shop-services section">
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
	<!-- End Shop Newsletter -->
	
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
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <!-- Product Slider -->
									<div class="product-gallery">
										<div class="quickview-slider-active">
											<div class="single-slider">
												<img src="images/modal1.jpg" alt="#">
											</div>
											<div class="single-slider">
												<img src="images/modal2.jpg" alt="#">
											</div>
											<div class="single-slider">
												<img src="images/modal3.jpg" alt="#">
											</div>
											<div class="single-slider">
												<img src="images/modal4.jpg" alt="#">
											</div>
										</div>
									</div>
								<!-- End Product slider -->
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <div class="quickview-content">
                                    <h2>Flared Shift Dress</h2>
                                    <div class="quickview-ratting-review">
                                        <div class="quickview-ratting-wrap">
                                            <div class="quickview-ratting">
                                                <i class="yellow fa fa-star"></i>
                                                <i class="yellow fa fa-star"></i>
                                                <i class="yellow fa fa-star"></i>
                                                <i class="yellow fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <a href="#"> (1 customer review)</a>
                                        </div>
                                        <div class="quickview-stock">
                                            <span><i class="fa fa-check-circle-o"></i> in stock</span>
                                        </div>
                                    </div>
                                    <h3>$29.00</h3>
                                    <div class="quickview-peragraph">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam.</p>
                                    </div>
									<div class="size">
										<div class="row">
											<div class="col-lg-6 col-12">
												<h5 class="title">Size</h5>
												<select>
													<option selected="selected">s</option>
													<option>m</option>
													<option>l</option>
													<option>xl</option>
												</select>
											</div>
											<div class="col-lg-6 col-12">
												<h5 class="title">Color</h5>
												<select>
													<option selected="selected">orange</option>
													<option>purple</option>
													<option>black</option>
													<option>pink</option>
												</select>
											</div>
										</div>
									</div>
                                    <div class="quantity">
										<!-- Input Order -->
										<div class="input-group">
											<div class="button minus">
												<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
													<i class="ti-minus"></i>
												</button>
											</div>
											<input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1">
											<div class="button plus">
												<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
													<i class="ti-plus"></i>
												</button>
											</div>
										</div>
										<!--/ End Input Order -->
									</div>
									<div class="add-to-cart">
										<a href="#" class="btn">Add to cart</a>
										<a href="#" class="btn min"><i class="ti-heart"></i></a>
										<a href="#" class="btn min"><i class="fa fa-compress"></i></a>
									</div>
                                    <div class="default-social">
										<h4 class="share-now">Share:</h4>
                                        <ul>
                                            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                            <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->
@endsection
@section('script_function')
	<script type="text/javascript">
		$('.del-product').click(function(){
			let session_id = $(this).data('session');
			const _token  = $('input[name="_token"]').val();
			swal({
			  title: "Are you sure?",
			  text: "Your will not be able to recover this imaginary file!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonClass: "btn-danger",
			  confirmButtonText: "Yes, delete it!",
			  closeOnConfirm: false
			},
			function(Confirm){
				if(Confirm){
					$.ajax({
						url:window.route('cart.destroy',[session_id]),
						method:'DELETE',
						data:{session_id:session_id,_token:_token},
						success:function(data){
							if(data == 1){
								swal("Deleted!", "Your imaginary file has been deleted.", "success");
								window.setTimeout(function(){
									location.reload();
								},1000);
							}
						}
					})
				}
			  
			});
			
		})
	</script>
@endsection