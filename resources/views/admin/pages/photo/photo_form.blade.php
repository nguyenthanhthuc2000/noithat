@extends('admin.layout')
@section('content')	
@include('config')
	<form action="{{URL::to($route,$id)}}" method="POST" enctype="multipart/form-data">
		@csrf
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
				<h2 class="h3 mb-3">{{$title}}</h2>
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
								@if(isset($detail) && $detail->photo != '')
								<img id="review-img" src="{{URL::to(IMGPHOTOS.$detail->photo)}}">
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
								<label class="form-label">Đường dẩn liên kết</label>
								<input type="hidden" name="type" value="@if(isset($type)){{$type}}@endif">
								<input type="text" class="form-control" value="@if(isset($detail)){{$detail->link}}@endif" name="link" placeholder="Đường dẩn liên kết">
							</div>
							<div class="form-group">
								<label class="form-label">Tên hình ảnh</label>
								<input type="text" class="form-control" name="tenvi" placeholder="Nhập tên hình ảnh"  value="@if(isset($detail)){{$detail->tenvi}}@endif">
							</div>
							@if(isset($motavi) && $motavi == true)
							<div class="form-group">
								<label class="form-label">Mô tả</label>
								<textarea class="form-control" placeholder="Nội dung mô tả" name="motavi" rows="4">@if(isset($detail)){{$detail->motavi}} @endif</textarea>
							</div>
							@endif
						</div>
					</div>

						
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection