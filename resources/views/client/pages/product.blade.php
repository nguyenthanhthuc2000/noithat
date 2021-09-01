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
	@if($products->count() > 0)
	<!-- Start Product Area -->
    <div class="product-area section">
        <div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>{{$title}}</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="product-info">
						<div class="nav-main">
							<!-- Tab Nav -->
<!-- 							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#accessories" role="tab">Tất cả</a></li>
								<li class="nav-item"><a class="nav-link " data-toggle="tab" href="#man" role="tab">Giá thấp đến cao</a></li>
								<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#women" role="tab">Giá cao đến thấp</a></li>
								<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kids" role="tab">Đang giảm giá</a></li>
								<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#essential" role="tab">Bán chạy nhất</a></li>

							</ul> -->
							<!--/ End Tab Nav -->
						</div>
						<div class="tab-content">
							<!-- Start Single Tab -->
							<div class="" id="" role="">
								<div class="tab-single">
									<div class="row">
										@foreach($products as $key => $product)
										<div class="col-xl-3 col-lg-4 col-md-4 col-12">
											<div class="single-product">
												<div class="product-img">
													<a href="{{route('chi-tiet-san-pham.show',$product->slug)}}">
														@if($product->photo == '')
															<img class="default-img" src="{{URL::to(IMG404)}}" alt="{{$product->tenvi}}">
														@else
															<img class="default-img" src="{{URL::to(IMGPRODUCTS.$product->photo)}}" alt="{{$product->tenvi}}">
														@endif
													</a>
													<div class="button-head">
														<div class="product-action">
															<a title="Quick View" href="{{route('chi-tiet-san-pham.show',$product->slug)}}"><i class=" ti-eye"></i><span>Quick Shop</span></a>
															<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														</div>
														<div class="product-action-2">
															<span> @if($product->soluong ==0) Hết hàng @else Còn {{$product->soluong }} sản phẩm @endif </span> 
														</div>
													</div>
												</div>
												<div class="product-content">
													<h3><a href="{{route('chi-tiet-san-pham.show',$product->slug)}}">{{$product->tenvi}}</a></h3>
													<div class="product-price">
				                                	@if($product->price_pro == '0' && $product->price == '0')
														Giá <span style="color:#f00;" ><a href="tel:11">Liên hệ</a></span>
													@elseif($product->price_pro == '0')
				                                    	Giá <span style="color:#f00;">{{number_format($product->price,'0',',','.')}}đ</span>
				                                    @else 
					                                   Giá <span style="color:#f00;">{{number_format($product->price_pro,'0',',','.')}}đ</span> 
					                                    <span class="old">{{number_format($product->price,'0',',','.')}}đ</span>
				                                    @endif
				                                </div>
				                                <div class="product-action-2">
													<form>
			                                            @csrf
			                                            <input type="hidden" name="" value="1" class="cart_product_qty_{{$product->id}}">
														<button type="button"title="Add to cart" data-id="{{$product->id}}" data-sl="{{$product->soluong}}" data-price="{{$product->price}}" class="add-cart btn-add-cart">Thêm giỏ hàng</button>
													</form>
												</div>
												</div>
											</div>
										</div>
										@endforeach
									</div>
								</div>
								<div class="paginate-styling">
									{{ $products->links()}}
								</div>
							</div>
							<!--/ End Single Tab -->
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
    @else
    <div class="product-area section">
        <div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Không tìm thấy sản phẩm phù hợp</h2>
					</div>
				</div>            
			</div>
		</div>
    </div>
    @endif

	<!-- End Product Area -->
@endsection