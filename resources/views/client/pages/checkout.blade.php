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
								<li class="active"><a href="blog-single.html">Checkout</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
	<div class=" cart-main section " hidden="" >
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
		<form method="POST" action="{{route('order.store')}}">	
			@csrf
		<!-- Start Checkout -->
			<section class="shop checkout section">
				<div class="container">
					<div class="row"> 
						<div class="col-lg-8 col-12">
							<div class="">
								<h2>Thanh toán</h2>
								<p>Điền thông tin nhận hàng</p>
								<div class="form">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Họ và tên người nhận<span>*</span></label>
												<input type="text" name="name" placeholder="" class="name" >
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Địa chỉ Email<span>*</span></label>
												<input type="email" placeholder=""  class="email">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Số điện thoại<span>*</span></label>
												<input type="text" placeholder=""  onkeypress="return isNumberKey(event)" class="phone">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Chi tiết số nhà, tên đường<span>*</span></label>
												<input type="text" name="address_house" placeholder=""  class="address_house">
											</div> 
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Tỉnh / TP<span>*</span></label>
												<select name="country_name" id="countrys" class="choose select__address_checkout countrys" required="">
													<option selected="">---Chọn Tỉnh/Thành Phố---</option>
													@foreach($CityProvinces as $CityProvince)
													<option value="{{$CityProvince->matp}}" data-name="{{$CityProvince->name_city}}">{{$CityProvince->name_city}}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Quận / Huyện<span>*</span></label>
												<select name="districts" id="districts"  class="choose districts select__address_checkout" required="">
													<option selected="">---Chọn Quận/Huyện---</option>
												</select>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Phường xã / Thị trấn<span>*</span></label>
												<select name="wards" id="wards" class="select__address_checkout wards" required="">
													<option selected="">---Chọn Phường xã/Thị trấn---</option>
												</select>
											</div>
										</div>
										@if(Session::get('coupon_session'))
											@foreach(Session::get('coupon_session') as $key => $cou)
											<input type="hidden" name="shipping_cou" class="shipping_cou" value="{{$cou['coupon_code']}}">
											@endforeach
										@else
											<input type="hidden" name="shipping_cou"class="shipping_cou" value="no">
										@endif
										<div class="col-lg-6 col-md-6 col-12">
											<div class="form-group">
												<label>Chi chú<span>*</span></label>
												<input type="text" name="post" placeholder="" class="note">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-12">
							<div class="order-details">
								<!-- Order Widget -->
								@if(Session::get('carts') == true )
									<div class="single-widget">
										<h2>Tổng hóa đơn</h2>
										<div class="content">
											<ul>
												<li>Hóa đơn<span>
												@if(session::get('coupon_session') == true)
													{{number_format(($Subtotal+$tax) - $coupon_money,0,',','.')}}
													@else
													{{number_format($Subtotal+$tax,0,',','.')}}
												@endif
												</span></li>
												<li>Phí giao hàng<span>Miễn phí</span></li>
												<li class="last">Thanh toán<span>
												@if(session::get('coupon_session') == true)
													{{number_format(($Subtotal+$tax) - $coupon_money,0,',','.')}}
													@else
													{{number_format($Subtotal+$tax,0,',','.')}}
												@endif
												</span></li>
											</ul>
										</div>
									</div>
								@endif
								<!--/ End Order Widget -->
								<!-- Order Widget -->
								<div class="single-widget">
									<h2>Hình thức thanh toán</h2>
									<div class="thanh-toan">
										<!-- <div class="form-check">
										  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" class="payment"value="tienmat" checked>
										  <label class="form-check-label" for="exampleRadios1">
										    Thanh toán khi nhận hàng
										  </label>
										</div>
										<div class="form-check">
										  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" class="payment"value="atm">
										  <label class="form-check-label" for="exampleRadios2">
										    Thanh toán qua ATM
										  </label>
										</div> -->
										<div class="form-group">
											<select  class="payment select__method_checkout" required="">
												<option value="" selected="">Chọn hình thức thanh toán</option>
												<option value="tienmat">Thanh toán khi nhận hàng</option>
												<!-- <option value="atm">Thanh toán qua ATM</option> -->
											</select>
										</div>
									</div>
								</div>
								<!--/ End Order Widget -->
								<!-- Payment Method Widget -->
								<div class="single-widget payement">
									<div class="content">
										<img src="{{URL::to('public/user/images/payment-method.png')}}" alt="#">
									</div>
								</div>
								<!--/ End Payment Method Widget -->
								<!-- Button Widget -->
								<div class="single-widget get-button">
									<div class="content">
										<div class="button">
											<button type="button" class="btn send-order">đặt hàng</button>
										</div>
									</div>
								</div>
								<!--/ End Button Widget -->
							</div>
						</div>
					</div>
				</div>
			</section>
		</form>	
		<!--/ End Checkout -->
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
		$('.choose').on('change',function(){
			let action = $(this).attr('id');
			let key = $(this).val();
			let _token = $('input[name="_token"]').val();
			let result = '';
			if(action == 'countrys'){
				result = 'districts';
			}
			else{
				result = 'wards';
			}
			$.ajax({
                url: window.route('shop.get_address'),
                method: 'POST',
                data:{action:action,key:key,_token:_token},
                success:function(data){
                    $('#'+result).html(data);
                }
            });
		})
		$('.send-order').click(function(){
			if($('.name').val() =='' || $('.email').val() =='' ||  $('.address_house').val() =='' ||  $('.phone').val() =='' ||   $('.countrys').val() =='' ||  $('.districts').val() =='' ||  $('.wards').val()  =='' || $('.payment').val()  ==''){
				swal("Thiếu thông tin", "Điền đầy đủ thông tin nhận hàng!", "success");
			}
			else{
				swal({
					title: "Đồng ý mua hàng?",
					text: "Chúng tôi sẽ liên hệ đến bạn trong thời gian sớm nhất để xác nhận đơn hàng! ",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "Ok, Tôi đồng ý!",
					closeOnConfirm: false
				},
				function(Confirm){
					if(Confirm){
						let email = $('.email').val();
	                    let name = $('.name').val();
	                    let address = $('.address_house').val()+', '+ $('.wards').find('option:selected').text() + ', ' + $('.districts').find('option:selected').text() + ', ' + $('.countrys').find('option:selected').text();
	                    let phone = $('.phone').val();
	                    let note = $('.note').val();
	                    let method = $('.payment').val();
	                    let shipping_cou = $('.shipping_cou').val();
	                    let _token = $('input[name="_token"]').val();
	                    $.ajax({
	                    	url:window.route('order.store'),
	                    	method:'POST',
	                    	data:{email:email,name:name,address:address,phone:phone,note:note,method:method,shipping_cou:shipping_cou,_token:_token},
	                    	success:function(data){
	                    		if(data == 1){
				  					swal("Mua hàng", "Đặt hàng thành công,Chúng tôi sẽ liên hệ bạn để xác nhận đơn hàng!", "success");
				  					window.setTimeout(function(){
							  			location.reload();
							  		},2000);
	                    		}
	                    	}

	                    })
				  		
					}
				});
			}
		})
	</script>
@endsection