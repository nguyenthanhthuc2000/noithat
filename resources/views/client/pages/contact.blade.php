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
							<li class="active"><a href="blog-single.html">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
  
	<!-- Start Contact -->
	<section id="contact-us" class="contact-us section">
		<div class="container">
				<div class="contact-head">
					<div class="row">
						<div class="col-md-12">
							@if(Session::get('error'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
							  <strong>{{Session::get('error')}}</strong> 
							  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							  {{session::forget('error')}}
							</div>
							@endif
							@if(Session::get('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
							  <strong>{{Session::get('success')}}</strong> 
							  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							  {{session::forget('success')}}
							</div>
							@endif
						</div>
						<div class="col-lg-8 col-12">
							<div class="form-main">
								<div class="title">
									<h4>Liên hệ</h4>
									<h3>Viết tin nhắn cho chúng tôi</h3>
								</div>
								<form class="form" method="post" action="{{route('shop.post_contact')}}">
									@csrf
									<div class="row">
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Họ và tên<span>*</span></label>
												<input name="name" type="text" placeholder="">
												<span class="error mess-error">{{ $errors->first('name') }}</span>
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Email<span>*</span></label>
												<input name="email" type="email" placeholder="">
											</div>	
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Điện thoại<span>*</span></label>
												<input name="phone" type="text" placeholder="">
												<span class="error mess-error">{{ $errors->first('phone') }}</span>
											</div>	
										</div>
										<div class="col-12">
											<div class="form-group message">
												<label>Nội dung tin nhắn<span>*</span></label>
												<textarea name="message" placeholder="Nội dung, trao đổi báo giá sản phẩm"></textarea>
												<span class="error mess-error">{{ $errors->first('message') }}</span>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group button">
												<button type="submit" class="btn ">Gửi tin nhắn</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="col-lg-4 col-12">
							<div class="single-head">
								<div class="single-info">
									<i class="fa fa-phone"></i>
									<h4 class="title">Call us Now:</h4>
									<ul>
										<li><a href="tel:{{$setting->hotline_1}}">{{$setting->hotline_1}}</li>
										<li><a href="tel:{{$setting->hotline_2}}">{{$setting->hotline_2}}</li>
									</ul>
								</div>
								<div class="single-info">
									<i class="fa fa-envelope-open"></i>
									<h4 class="title">Email:</h4>
									<ul>
										<li><a href="mailto:{{$setting->email}}">{{$setting->email}}</a></li>
									</ul>
								</div>
								<div class="single-info">
									<i class="fa fa-location-arrow"></i>
									<h4 class="title">Our Address:</h4>
									<ul>
										<li>{{$setting->direct}}</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
	<!--/ End Contact -->
	
	<!-- Map Section -->
	<div class="map-section">
		<div id="myMap">
			{!!$setting->iframe_google_map!!}
		</div>
	</div>
	<!--/ End Map Section -->
	
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

@endsection