		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-left">
							<ul class="list-main">
								<li><i class="ti-headphone-alt"></i>{{$setting->hotline_1}} @if($setting->hotline_2 !='' && $setting->hotline_1 !='') - @endif {{$setting->hotline_2}} </li>
							</ul>
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-4 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-bettwen">
							<ul class="list-main">
								<li><i class="ti-email"></i> {{$setting->email}}</li>
							</ul>
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-4 col-md-12 col-12">
						<!-- Top Right -->
						<div class="right-content">
							<ul class="list-main">
								<li><i class="ti-alarm-clock"></i> <a href="#">{{$setting->open_time}}</a></li>
							</ul>
						</div>
						<!-- End Top Right -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="{{URL::to('/trang-chu')}}"><img src="{{URL::to(IMGPHOTOS.$logo_header->photo)}}" alt="logo"></a>
						</div>
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top">
							<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
								<form class="search-form" action="{{route('search.product')}}" method="get">
									@csrf
									<input type="text" placeholder="Tìm kiêm..." name="search">
									<button value="search" type="submit" ><i class="ti-search"></i></button>
								</form>
							</div>
							<!--/ End Search Form -->
						</div>
						<!--/ End Search Form -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-8 col-md-7 col-12">
						<div class="search-bar-top">
							<div class="search-bar">
								<form  action="{{route('search.product')}}" method="get">
									@csrf
									<input name="search" class="form-control" placeholder="Tìm kiêm..." type="search">
									<button class="btnn"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-12">
 						<div class="right-bar">
							<!-- Search Form -->
							<div class="sinlge-bar">
								<a href="login.html" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar shopping">
								<a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count">2</span></a>
								<!-- Shopping Item -->
								<div class="shopping-item">
									<div class="dropdown-cart-header">
										<span>2 Items</span>
										<a href="cart.html">View Cart</a>
									</div>
									<ul class="shopping-list">
										<li>
											<a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
											<a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
											<h4><a href="#">Woman Ring</a></h4>
											<p class="quantity">1x - <span class="amount">$99.00</span></p>
										</li>
										<li>
											<a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
											<a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
											<h4><a href="#">Woman Necklace</a></h4>
											<p class="quantity">1x - <span class="amount">$35.00</span></p>
										</li>
									</ul>
									<div class="bottom">
										<div class="total">
											<span>Total</span>
											<span class="total-amount">$134.00</span>
										</div>
										<a href="checkout.html" class="btn animate">Checkout</a>
									</div>
								</div>
								<!--/ End Shopping Item -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						<div class="col-lg-12 col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">	
										<div class="nav-inner">	
											<ul class="nav main-menu menu navbar-nav">
													<li class="menu_top"><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
													<li class="menu_top" ><a href="{{route('san-pham.index')}}">Sản phẩm<i class="ti-angle-down"></i></a>
														<ul class="dropdown">
															@foreach($Categorys as $key => $Category)
																<?php $checkcat = 0; ?>
																@foreach($Items as $key => $Item)
																	@if($Item->id_parent == $Category->id)
																		<?php $checkcat++; ?>
																	@endif
																@endforeach
															<li><a href="{{route('san-pham.show',$Category->slug)}}">{{$Category->tenvi}}
																@if($checkcat > 0)
																<i class=" ti-angle-down "></i>
																@endif
																</a>
																@if($checkcat > 0)
																<ul class="dropdown2">
																	@foreach($Items as $key => $Item)
																		@if($Item->id_parent == $Category->id)
																		<li><a href="{{route('san-pham.show',$Item->slug)}}">{{$Item->tenvi}}</a></li>
																		@endif
																	@endforeach
																</ul>
																@endif
															</li>
															@endforeach
														</ul>
													</li>
													<li class="menu_top"><a>Thương hiệu<i class="ti-angle-down"></i></a>
														<ul class="dropdown">
															@foreach($Brands as $key => $brand)
															<li><a href="{{route('thuong-hieu.show',$brand->slug)}}">{{$brand->tenvi}}</a></li>
															@endforeach
														</ul>
													</li>													
													<li class="menu_top"><a href="#">Dịch vụ <i class="ti-angle-down"></i><span class="new">New</span></a>
														<ul class="dropdown">
															@foreach($servicenbs as $key => $servicenb)
																<li><a href="{{route('chi-tiet-bai-viet.show',$servicenb->slug)}}">{{$servicenb->tenvi}}</a></li>
															@endforeach
														</ul>
													</li>							
													<li><a >Bài viết<i class="ti-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="blog-single-sidebar.html">Tuyển dụng</a></li>
															<li><a href="blog-single-sidebar.html">Chính sách</a></li>
															<li><a href="blog-single-sidebar.html">Bài viết</a></li>
														</ul>
													</li>
													<li class="menu_top"><a href="#">Tài khoản <i class="ti-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="{{route('cart.index')}}">Giỏ hàng</a></li>
															<li><a href="checkout.html">Thanh toán</a></li>
															
															<?php
							                                   $user_name = Session::get('user_name');
							                                   if($user_name!=NULL){ 
							                                 ?>
															<li><a href="{{route('shop.logout')}}">Đăng xuất</a></li>
															<?php
								                            }else{
								                                 ?>
							                                 <li><a href="{{route('shop.viewlogin')}}">Đăng nhập</a></li>
							                                 <?php 
							                             		}
							                                 ?>
														</ul>
													</li>
													<li class="menu_top"><a href="contact.html">Giới thiệu</a></li>
													<li class="menu_top"><a href="{{route('shop.contact')}}">Liên hệ</a></li>
											</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
