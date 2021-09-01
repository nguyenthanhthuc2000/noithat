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
								<li class="active"><a href="blog-single.html">Blog Single Sidebar</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
			
		<!-- Start Blog Single -->
		<section class="blog-single section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="blog-single-main">
							<div class="row">
								<div class="col-12">
										<h2 class="blog-title">{{$getDetailPro->tenvi}}</h2>
									<div class="image">
										@if($getDetailPro->photo == '')
											<img class="default-img" src="{{URL::to(IMG404)}}" alt="#">
										@else
											<img class="default-img" src="{{URL::to(IMGPRODUCTS.$getDetailPro->photo)}}" alt="#">
										@endif
									</div>
									<div class="blog-detail">
										<div class="sub-product">
											<a href="" class="xem-them-hinh-anh">
												<span><i class="fa fa-image"></i></span>
												<span>Xem thêm </span> 5 <span>ảnh</span>
											</a>
											<a href="" class="xem-them-hinh-anh">
												<span><i class="fa fa-youtube"></i></span>
												<span>Xem video</span>
											</a>
										</div>
										<div class="blog-meta">
											<span class="author"><a href="#"><i class="fa fa-calendar"></i>10-12-2029</a><a href="#"><i class="fa fa-comments"></i>Bình luận (15)</a></span>
										</div>
										<div class="content content_detail_product">
											{!! $getDetailPro->noidungvi !!}
										</div>
									</div>
								</div>

								<div class="col-12">
									<div class="comments">
										<h3 class="comment-title">Comments (3)</h3>
										<!-- Single Comment -->
										<div class="single-comment">
											<img src="https://via.placeholder.com/80x80" alt="#">
											<div class="content">
												<h4>Alisa harm <span>At 8:59 pm On Feb 28, 2018</span></h4>
												<p>Enthusiastically leverage existing premium quality vectors with enterprise-wide innovation collaboration Phosfluorescently leverage others enterprisee  Phosfluorescently leverage.</p>
												<div class="button">
													<a href="#" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
												</div>
											</div>
										</div>
										<!-- End Single Comment -->
										<!-- Single Comment -->
										<div class="single-comment left">
											<img src="https://via.placeholder.com/80x80" alt="#">
											<div class="content">
												<h4>john deo <span>Feb 28, 2018 at 8:59 pm</span></h4>
												<p>Enthusiastically leverage existing premium quality vectors with enterprise-wide innovation collaboration Phosfluorescently leverage others enterprisee  Phosfluorescently leverage.</p>
												<div class="button">
													<a href="#" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
												</div>
											</div>
										</div>
										<!-- End Single Comment -->
										<!-- Single Comment -->
										<div class="single-comment">
											<img src="https://via.placeholder.com/80x80" alt="#">
											<div class="content">
												<h4>megan mart <span>Feb 28, 2018 at 8:59 pm</span></h4>
												<p>Enthusiastically leverage existing premium quality vectors with enterprise-wide innovation collaboration Phosfluorescently leverage others enterprisee  Phosfluorescently leverage.</p>
												<div class="button">
													<a href="#" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
												</div>
											</div>
										</div>
										<!-- End Single Comment -->
									</div>									
								</div>											
								<div class="col-12">			
									<div class="reply">
										<div class="reply-head">
											<h2 class="reply-title">Để lại bình luận</h2>
											<!-- Comment Form -->
											<form class="form" action="#">
												<div class="row">
													<div class="col-lg-6 col-md-6 col-12">
														<div class="form-group">
															<label>Tên của bạn<span>*</span></label>
															<input type="text" name="name" placeholder="" required="required">
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-12">
														<div class="form-group">
															<label>Email của bạn<span>*</span></label>
															<input type="email" name="email" placeholder="" required="required">
														</div>
													</div>
													<div class="col-12">
														<div class="form-group">
															<label>Nội dung<span>*</span></label>
															<textarea name="message"  placeholder=""></textarea>
														</div>
													</div>
													<div class="col-12">
														<div class="form-group button">
															<button type="submit" class="btn">Post comment</button>
														</div>
													</div>
												</div>
											</form>
											<!-- End Comment Form -->
										</div>
									</div>			
								</div>			
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="main-sidebar">
							<div class="single-widget">
								Giá:
								@if($getDetailPro->price == 0 && $getDetailPro->price_pro == 0)
								<span class="new-price">Liên hệ</span>
								@elseif($getDetailPro->price_pro == 0)
								<span class="new-price">{{number_format($getDetailPro->price,'0',',','.')}}đ</span>
								@else
								<span class="new-price">{{number_format($getDetailPro->price_pro,'0',',','.')}}đ</span>&ensp;<span class="old-price">{{number_format($getDetailPro->price,'0',',','.')}}đ</span>
								@endif
							</div>
							<!-- Single Widget -->
							<div class="single-widget recent-post">
								<h3 class="title">Thông tin sản phẩm</h3>
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td>Chất liệu</td>
											<td>
												@if($getDetailPro->chatlieu != '')
												 	{{ $getDetailPro->chatlieu }} 
												@else 
													Chưa cập nhật
												@endif
											</td>
										</tr>
										<tr>
											<td>Màu sắc</td>
											<td>
												@if($getDetailPro->mausac != '')
												 	{{ $getDetailPro->mausac }} 
												@else 
													Chưa cập nhật
												@endif
											</td>
										</tr>
										<tr>
											<td>Kích thước</td>
											<td>
												@if($getDetailPro->kichthuoc != '')
												 	{{ $getDetailPro->kichthuoc }} 
												@else 
													Chưa cập nhật
												@endif

											</td>
										</tr>
										<tr>
											<td>Nơi sản xuất</td>
											<td>
												@if($getDetailPro->noisanxuat != '')
												 	{{ $getDetailPro->noisanxuat }} 
												@else 
													Chưa cập nhật
												@endif
											</td>
										</tr>
										<tr>
											<td>Bổ sung</td>
											<td>
												@if($getDetailPro->bosung != '')
												 	{{ $getDetailPro->bosung }} 
												@else 
													Chưa cập nhật
												@endif
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="mua-ngay single-widget">
								<form>
									@csrf
									<input type="number" class="cart_product_qty_{{$getDetailPro->id}}" min="1" value="1" name="">
									<button type="button" class="btn btn-primary add-cart" data-id="{{$getDetailPro->id}}" data-sl="{{$getDetailPro->soluong}}" data-price="{{$getDetailPro->price}}" >Thêm vào giỏ hàng</button>
								</form>
							</div>
							<!-- Single Widget -->
							<div class="single-widget recent-post">
								<h3 class="title">Thông tin khuyến mãi</h3>
								<div class="thong-tin-km">
									@if($getDetailPro->noidungkm != '')
										{!!$getDetailPro->noidungkm!!}
									 	 <!-- or<?php echo htmlspecialchars_decode($getDetailPro->noidungkm) ?>  -->
									@else 
										Sản phẩm này không có khuyến mãi
									@endif
								</div>

							</div>
							<!-- Single Widget -->
							<div class="single-widget side-tags">
								<h3 class="title">Tags</h3>
								<ul class="tag">
									@foreach($getTagProducts as $getTagProduct)
									<li><a href="{{route('product.tag',$getTagProduct->slug)}}">{{$getTagProduct->tenvi}}</a></li>
									@endforeach
								</ul>
							</div>
							<!--/ End Single Widget -->
							<!-- Single Widget -->
							<div class="single-widget newsletter">
								<h3 class="title">Đăng ký nhận tin</h3>
								<div class="letter-inner">
									<h4>Subscribe & get news <br> latest updates.</h4>
									<div class="form-inner">
										<input type="email" placeholder="Enter your email">
										<a href="#">Submit</a>
									</div>
								</div>
							</div>
							<!--/ End Single Widget -->
						</div>
					</div>
				</div>
			</div>
		</section>
@endsection
			