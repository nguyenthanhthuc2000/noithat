@extends('admin.layout')
@section('content')
		<div class="container-fluid p-0">
			<div class=" row">
				<div class="col-md-6">
					<h1 class="h3 mb-3">Thông tin tài khoản</h1>
				</div>
				<div class="col-md-6">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="card mb-3">
						<div class="card-body text-center">
							@if(Auth::user()->avatar != '')
			                  <img src="{{asset('public/uploads/avatars/'.Auth::user()->avatar)}}" class="img-fluid rounded-circle mb-2" alt="{{Auth::user()->name;}}" width="128" height="128"/>
			                @else
			                  <img src="{{asset('public/uploads/avatars/avatar.jpg')}}" class="img-fluid rounded-circle mb-2" alt="admin" width="128" height="128"/>
			                @endif 
							<h5 class="card-title mb-0">{{Auth::user()->name}}</h5>
							<div class="text-muted mb-2">Mod</div>
							<div>
								<a class="btn btn-primary btn-sm" href="#"><span data-feather="message-square"></span> Message Zalo</a>
							</div>
						</div>
							<hr class="my-0" />
						<div class="card-body">
							<h5 class="h6 card-title">Thông tin</h5>
							<ul class="list-unstyled mb-0">
								<li class="mb-1"><span data-feather="home" class="feather-sm mr-1"></span><a >{{Auth::user()->address}}</a></li>
								<li class="mb-1"><span data-feather="phone" class="feather-sm mr-1"></span><a href="tel:{{Auth::user()->phone}}">{{Auth::user()->phone}}</a></li>
								<li class="mb-1"><span data-feather="mail" class="feather-sm mr-1"></span><a href="mailto:{{Auth::user()->email}}">{{Auth::user()->email}}</a></li>
								<li class="mb-1"><span data-feather="map-pin" class="feather-sm mr-1"></span> Permission <strong>HTML</strong></li>

							</ul>
						</div>
					</div>
				</div>

				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							<div class="nav nav-pills nav-fill box-tab-profile">
							    <button class="nav-link tab-profile active" aria-current="page" id="tab-doimatkhau" >Đổi mật khẩu</button>
							    <button class="nav-link tab-profile"  id="tab-hoatdong">Hoạt động</button>
							</div>
						</div>
						<div id="box-body">
							<div class="card-body h-100 d-none" id="hoatdong" >

								<div class="media">
									@if(Auth::user()->avatar != '')
					                  <img src="{{asset('public/uploads/avatars/'.Auth::user()->avatar)}}" class="rounded-circle mr-2" alt="{{Auth::user()->name;}}" width="36" height="36"/>
					                @else
					                  <img src="{{asset('public/uploads/avatars/avatar.jpg')}}" class="rounded-circle mr-2" alt="admin"width="36" height="36"/>
					                @endif 
									<div class="media-body">
										<small class="float-right text-navy">5m ago</small>
										<strong>Vanessa Tucker</strong> started following <strong>Christina Mason</strong><br />
										<small class="text-muted">Today 7:51 pm</small><br />

									</div>
								</div>

								<hr />
								<div class="media">
									@if(Auth::user()->avatar != '')
					                  <img src="{{asset('public/uploads/avatars/'.Auth::user()->avatar)}}" class="rounded-circle mr-2" alt="{{Auth::user()->name;}}" width="36" height="36"/>
					                @else
					                  <img src="{{asset('public/uploads/avatars/avatar.jpg')}}" class="rounded-circle mr-2" alt="admin"width="36" height="36"/>
					                @endif 
									<div class="media-body">
										<small class="float-right text-navy">1h ago</small>
										<strong>Christina Mason</strong> posted a new blog<br />

										<small class="text-muted">Today 6:35 pm</small>
									</div>
								</div>

								<hr />
								<div class="media">
									@if(Auth::user()->avatar != '')
					                  <img src="{{asset('public/uploads/avatars/'.Auth::user()->avatar)}}" class="rounded-circle mr-2" alt="{{Auth::user()->name;}}" width="36" height="36"/>
					                @else
					                  <img src="{{asset('public/uploads/avatars/avatar.jpg')}}" class="rounded-circle mr-2" alt="admin"width="36" height="36"/>
					                @endif 
									<div class="media-body">
										<small class="float-right text-navy">3h ago</small>
										<strong>William Harris</strong> posted two photos on <strong>Christina Mason</strong>'s timeline<br />
										<small class="text-muted">Today 5:12 pm</small>

									</div>
								</div>

								<hr />
								<div class="media">
									@if(Auth::user()->avatar != '')
					                  <img src="{{asset('public/uploads/avatars/'.Auth::user()->avatar)}}" class="rounded-circle mr-2" alt="{{Auth::user()->name;}}" width="36" height="36"/>
					                @else
					                  <img src="{{asset('public/uploads/avatars/avatar.jpg')}}" class="rounded-circle mr-2" alt="admin"width="36" height="36"/>
					                @endif 
									<div class="media-body">
										<small class="float-right text-navy">1d ago</small>
										<strong>Christina Mason</strong> posted a new blog<br />
										<small class="text-muted">Yesterday 2:43 pm</small>
									</div>
								</div>

								<hr />
								<div class="media">
									@if(Auth::user()->avatar != '')
					                  <img src="{{asset('public/uploads/avatars/'.Auth::user()->avatar)}}" class="rounded-circle mr-2" alt="{{Auth::user()->name;}}" width="36" height="36"/>
					                @else
					                  <img src="{{asset('public/uploads/avatars/avatar.jpg')}}" class="rounded-circle mr-2" alt="admin"width="36" height="36"/>
					                @endif 
									<div class="media-body">
										<small class="float-right text-navy">1d ago</small>
										<strong>Charles Hall</strong> started following <strong>Christina Mason</strong><br />
										<small class="text-muted">Yesterdag 1:51 pm</small>
									</div>
								</div>

								<hr />
								<a href="#" class="btn btn-primary btn-block">Load more</a>
							</div>
							<div class="card-body h-100 " id="doimatkhau" >
									<form>
										@csrf
										<div class="form-group">
											<label for="inputPasswordCurrent">Mật khẩu cũ</label>
											<input type="password" class="form-control currentpassword" id="inputPasswordCurrent" name="currentpassword" required="">
											<small><a href="#">Quên mật khẩu?</a></small>
										</div>
										<div class="form-group">
											<label for="inputPasswordNew">Mật khẩu mới</label>
											<input type="text"  name="newpassword"class="form-control newpassword" value=""required="" id="inputPasswordNew">
										</div>
										<div class="form-group">
											<label for="inputPasswordNew2">Nhập lại mật khẩu</label>
											<input type="text" required="" value="" name="verifypassword" class="form-control verifypassword" id="inputPasswordNew2">
										</div>
										<button type="button" data-id="{{Auth::user()->id;}}"class="btn btn-primary btn-update">Save changes</button>
									</form>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		@endsection

@section('script_function')
	<script type="text/javascript">
		$('.tab-profile').click(function(){
			$('.box-tab-profile .tab-profile').removeClass('active');
			$(this).addClass('active');
		})
		$('#tab-hoatdong').click(function(){
			$('#box-body .card-body').addClass('d-none');
			$('#box-body #hoatdong').removeClass('d-none');
		});
		$('#tab-doimatkhau').click(function(){
			$('#box-body .card-body').addClass('d-none');
			$('#box-body #doimatkhau').removeClass('d-none');
		});
		$('.btn-update').click(function(){
			let currentpassword = $('.currentpassword').val();
			let verifypassword = $('.verifypassword').val();
			let newpassword = $('.newpassword').val();
			let id = $(this).data('id');
			const _token  = $('input[name="_token"]').val();

			if(currentpassword == '' || verifypassword=='' || newpassword==''){
				swal("Error!", "Nhập đầy đủ thông tin đi má", "error");
			}
			else{
				swal({
					title: "Bạn có chắc chắn ?",
					text: "Vui lòng nhớ kĩ mật khẩu trước khi đổi! Đổi xong mà quên thì phạt 100k nhé!",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "OK, Nhớ rồi !",
					closeOnConfirm: false
				},
				function(isConfirm){
					if(isConfirm){
						if(verifypassword != newpassword ){
							swal("Error!", "Mật khẩu mới phải trùng nhau", "error");
						}
						else{
							$.ajax({
								url:window.route('admin.update',id),
								method:'PUT',
								data:{currentpassword:currentpassword,verifypassword:verifypassword,newpassword:newpassword,_token:_token},
								success:function(data){
									if(data == 1){
										swal("Success!", "Đổi mật khẩu thành công.Vui lòng đăng nhập lại", "success");
										window.setTimeout(function(){
											window.location.href = window.route('admin.logout');
										},2000);
									}
									else if(data == 0){
										swal("Error!", "Sai mật khẩu cũ!", "error");
									}
								}
							})
						}
					}
				});
			}
		})
	</script>
@endsection