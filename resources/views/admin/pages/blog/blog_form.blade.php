@extends('admin.layout')
@section('content')	
@include('config')
	<form action="{{URL::to($route.'/'.$id)}}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="container-fluid p-0">
			<div class="title-form">
				<h2 class="h3 mb-3">Thông tin bài viết</h2>
				<button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="check-circle"></i> Lưu</button>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label class="form-label">Đường dẩn</label>
								<input type="hidden" name="type" value="@if(isset($type)){{$type}}@endif">
								<input type="text" class="form-control" id="convert_slug" value="@if(isset($detail)){{$detail->slug}}@endif" name="slug" placeholder="Đường dẩn">
								@if(Session::get('error_slug'))
								<span class="error mess-error">{{Session::get('error_slug')}}</span>
								{{session::forget('error_slug')}}
								@endif
								<span class="error mess-error">{{ $errors->first('slug') }}</span>
							</div>
							<div class="form-group">
								<label class="form-label">Tên bài viết</label>
								<input type="text" class="form-control" name="tenvi"onkeyup="ChangeToSlug();" id="slug" placeholder="Nhập tên bài viết"  value="@if(isset($detail)){{$detail->tenvi}}@endif">
								 <span class="error mess-error">{{ $errors->first('tenvi') }}</span>
								 <div class="invalid-feedback"><em></em> Tên danh mục không được để trống</div>
							</div>
							<div class="form-group">
								<label class="form-label">Mô tả bài viết</label>
								<textarea class="form-control" placeholder="Nhập mô tả bài viết" rows="3" name="motavi" rows="3">@if(isset($detail)){{$detail->motavi}}@endif</textarea>
							</div>
							<div class="form-group">
								<label class="form-label">Nội dung</label>
								<textarea class="form-control" placeholder="Textarea" id="ckproduct_content" name="noidungvi" >@if(isset($detail)){{$detail->noidungvi}}@endif</textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label class="form-label w-100">Ảnh đại diện</label>
								<input type="file" id="input_file_img" name="photo" onchange="review_img(event)">
								<small class="form-text text-muted">Yêu cầu kích thước: 500x600px</small>
							</div>
							<div class="review-img">
								@if(isset($detail) && $detail->photo != '')
								<img id="review-img" src="{{URL::to(IMGBLOG.$detail->photo)}}">
								@else
								<img id="review-img" src="{{URL::to(IMG404)}}">
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label class="form-label">Seo title</label>
								<textarea class="form-control" placeholder="Nhập Seo title"  name="seo_title" rows="2">@if(isset($detail)){{
								$detail->seo_title}}@endif</textarea>
							</div>
							<div class="form-group">
								<label class="form-label">Seo keywords</label>
								<textarea class="form-control" placeholder="Nhập Seo keywords" rows="2" name="seo_keywords" >@if(isset($detail)){{
								$detail->seo_keywords}}@endif</textarea>
							</div>
							<div class="form-group">
								<label class="form-label">Seo description</label>
								<textarea class="form-control" placeholder="Seo description" rows="2" name="seo_description">@if(isset($detail)){{
								$detail->seo_description}}@endif</textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection