<!-- Jquery -->

    <script src="{{asset('public/user/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/user/js/jquery-migrate-3.0.0.js')}}"></script>
	<script src="{{asset('public/user/js/jquery-ui.min.js')}}"></script>
	<!-- Popper JS -->
	<script src="{{asset('public/user/js/popper.min.js')}}"></script>
	<!-- Bootstrap JS -->
	<script src="{{asset('public/user/js/bootstrap.min.js')}}"></script>
	<!-- Color JS -->
	<script src="{{asset('public/user/js/colors.js')}}"></script>
	<!-- Slicknav JS -->
	<script src="{{asset('public/user/js/slicknav.min.js')}}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{asset('public/user/js/owl-carousel.js')}}"></script>
	<!-- Magnific Popup JS -->
	<script src="{{asset('public/user/js/magnific-popup.js')}}"></script>
	<!-- Waypoints JS -->
	<script src="{{asset('public/user/js/waypoints.min.js')}}"></script>
	<!-- Countdown JS -->
	<script src="{{asset('public/user/js/finalcountdown.min.js')}}"></script>
	<!-- Nice Select JS -->
	<script src="{{asset('public/user/js/nicesellect.js')}}"></script>
	<!-- Flex Slider JS -->
	<script src="{{asset('public/user/js/flex-slider.js')}}"></script>
	<!-- ScrollUp JS -->
	<script src="{{asset('public/user/js/scrollup.js')}}"></script>
	<!-- Onepage Nav JS -->
	<script src="{{asset('public/user/js/onepage-nav.min.js')}}"></script>
	<!-- Easing JS -->
	<script src="{{asset('public/user/js/easing.js')}}"></script>
	<!-- Active JS -->
	<script src="{{asset('public/user/js/active.js')}}"></script>
	<!-- Slick JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
	<script src="{{asset('public/user/js/script.js')}}"></script>
	<script src="{{asset('public/vendor/js/sweetalert.js')}}"></script>

	<script type="text/javascript">
			$(".main-menu li a").filter(function(){
				return this.href == location.href;
			}).parents("li").addClass("active");
	</script>
	<!-- add cart -->
	<script type="text/javascript">
		$('.add-cart').click(function(){
			let id = $(this).data('id');
            let cart_product_qty = $('.cart_product_qty_' +id).val();
            // let _token = $('input[name="_token"]').val();
			if( $(this).data('sl') == '0'){
    			swal("S???n ph???m ???? h???t h??ng!", "Vui l??ng quay l???i sau! Ho???c LH shop ????? ???????c t?? v???n", "error");
			}
			else if($(this).data('price') == '0'){
				swal("Li??n h??? ch??? shop!", "Li??n h??? ch??? CSKH ????? ???????c b??o gi??", "error");
			}
			else{
				 $.ajax({
                	url:window.route('cart.store'),
                	method:'POST',
                	data:{id:id,_token:"{{ csrf_token() }}",cart_product_qty:cart_product_qty},
                	success:function(data){
                		if(data==1){
							swal("Th??m gi??? h??ng th??nh c??ng!", "Ti???p t???c mua h??ng!", "success");
                		}else{
            				swal("Th???t b???i!", "Th??? l???i sau!", "error");
                		}
                	}
                })
			}
		})
	</script>

  @yield('script_function')
  