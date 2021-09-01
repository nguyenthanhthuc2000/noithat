	<!-- Start Footer Area -->
	<footer class="footer">
		<!-- Footer Top -->
		<div class="footer-top section">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer about social">
							<div class="logo">
								<a href=""><img src="{{URL::to(IMGPHOTOS.$logo_footer->photo)}}" alt="#"></a>
							</div>
							<p class="text">{{$setting->slogan}}</p>
							<p class="call">Liên hệ 24/7<span><a href="tel:{{$setting->hotline_1}}">{{$setting->hotline_1}} </a> @if($setting->hotline_2 !='' && $setting->hotline_1 !='')  or @endif<a href="tel:{{$setting->hotline_2}}">{{$setting->hotline_2}}</a></span></p>
							<ul>
								<li><a href="{{$setting->link_fanpage}}"><i class="ti-facebook"></i></a></li>
								<li><a href="{{$setting->link_fanpage}}"><i class="ti-twitter"></i></a></li>
								<li><a href="{{$setting->link_fanpage}}"><i class="ti-youtube"></i></a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Chính sá	ch</h4>
							<ul>
								@foreach($chinhsachs as $chinhsach)
								<li><a href="{{route('chi-tiet-bai-viet.show',$chinhsach->slug)}}">{{$chinhsach->tenvi}}</a></li>
								@endforeach
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer ">
							<h4>Fanpage</h4>
							<!-- Single Widget -->
							<div class="contact">
								<div class="fb-page" data-href="https://www.facebook.com/DienDanSinhVienCaoThang" data-tabs="timeline" data-adapt-container-width="true" data-height="220" data-small-header="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/DienDanSinhVienCaoThang" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/DienDanSinhVienCaoThang">Cộng đồng Sinh viên Trường Cao Đẳng Kỹ Thuật Cao Thắng</a></blockquote></div>
							</div>
							<!-- End Single Widget -->
							
						</div>
						<!-- End Single Widget -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer Top -->
		<div class="copyright">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="left">
								<p>Copyright © 2021 <a href="https://www.facebook.com/thuc.nguyenthanh.thuc2402/" target="_blank">NTT</a>  -  All Rights Reserved.</p>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="right">
								<img src="{{URL::to('public/user/images/payments.png')}}" alt="#">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /End Footer Area -->