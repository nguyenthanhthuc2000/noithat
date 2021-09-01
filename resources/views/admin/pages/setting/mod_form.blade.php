@extends('admin.layout')
@section('content')	
@include('config')
	<form action="{{route($route,$id)}}" method="POST"  enctype="multipart/form-data">
		@csrf
		@if($id != '')
        	@method('put')
        @endif
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
		<div class="container-fluid p-0">
			<div class="title-form">
				<h2 class="h3 mb-3">Thông tin tài khoản mod</h2>
				<button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="check-circle"></i> Lưu</button>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label class="form-label w-100">Hình ảnh</label>
								<input type="file" id="input_file_img" name="photo" onchange="review_img(event)">
								<small class="form-text text-muted">Yêu cầu kích thước: 500x600px</small>
							</div>
							<div class="review-img">
								@if(isset($detail) && $detail->avatar != '')
								<img id="review-img" src="{{URL::to(AVATARS.$detail->avatar)}}">
								@else
								<img id="review-img" src="{{URL::to(IMG404)}}">
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label class="form-label">Tên</label>
								<input type="text" class="form-control" value="@if(isset($detail)){{$detail->name}}@endif" name="name" placeholder="Họ và tên">
							</div>
							<div class="form-group">
								<label class="form-label">Email</label>
								<input type="email" class="form-control" name="email" placeholder="Địa chỉ email"  value="@if(isset($detail)){{$detail->email}}@endif">
							</div>
							<div class="form-group">
								<label class="form-label">Sđt/Zalo</label>
								<input type="text" class="form-control" name="phone" placeholder="Số điện thoại /zalo"  value="@if(isset($detail)){{$detail->phone}}@endif">
							</div>
							<div class="form-group">
								<label class="form-label">Địa chỉ</label>
								<input type="address" class="form-control" name="address" placeholder="Địa chỉ cư trú"  value="@if(isset($detail)){{$detail->address}}@endif">
							</div>
							<div class="form-group">
								<label class="form-label">Facebook</label>
								<input type="text" class="form-control" name="facebook" placeholder="Địa chỉ facebook"  value="@if(isset($detail)){{$detail->facebook}}@endif">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection