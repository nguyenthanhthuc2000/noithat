@extends('admin.layout')
@section('content')
	@include('config')
	<div class="container-fluid p-0">
		<form action="{{route($route,$id)}}"  method="POST" enctype="multipart/form-data">
			@csrf
			@if($id != '')
	        	@method('put')
	        @endif
		<div class="title-form">
			<h2 class="h3 mb-3">Thông tin danh mục cấp 2</h2>
			<button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="check-circle"></i> Lưu</button>
		</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<input type="hidden" class="form-control" name="type" value="lv2">
							<div class="form-group">
								<label class="form-label">Đường dẩn</label>
								<input type="text" class="form-control" id="convert_slug" value="@isset($slug){{$slug}}@endisset" name="slug"  placeholder="Đường dẩn">
								@if(Session::get('error'))
								<span class="error mess-error">{{Session::get('error')}}</span>
								{{session::forget('error')}}
								@endif
							</div>
							<div class="form-group">
								<label class="form-label">Tên danh mục</label>
								<input type="text" class="form-control" name="tenvi" onkeyup="ChangeToSlug();" id="slug" value="@isset($tenvi){{$tenvi}}@endisset" placeholder="Nhập tên danh mục">
							</div>
							<div class="form-group">
								<label for="inputState">Danh mục cấp 1</label>
								<select id="inputState" class="form-control" name="id_parent">
								@if(isset($info_parent))
									<option selected value="{{$info_parent->id}}" >{{$info_parent->tenvi}}</option>
								@else
				                <option value="" >Chọn danh mục cấp 1</option>
								@endif

				                @foreach($Categorys as $key => $Category)
				                	<option value="{{$Category->id}}">{{$Category->tenvi}}</option>
				                @endforeach
				              </select>
				              	@if(Session::get('selectlv1'))
								<span class="error mess-error">{{Session::get('selectlv1')}}</span>
								{{session::forget('selectlv1')}}
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label class="form-label">Seo title</label>
								<textarea class="form-control" placeholder="Nhập Seo title"  name="seo_title" rows="2">@isset($seo_title){{$seo_title}} @endisset</textarea>
							</div>
							<div class="form-group">
								<label class="form-label">Seo keywords</label>
								<textarea class="form-control" placeholder="Nhập Seo keywords" rows="2" name="seo_keywords" >@isset($seo_keywords){{$seo_keywords}} @endisset</textarea>
							</div>
							<div class="form-group">
								<label class="form-label">Seo description</label>
								<textarea class="form-control" placeholder="Seo description" rows="2" name="seo_description">@isset($seo_description){{$seo_description}} @endisset</textarea>
							</div>
							<button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="check-circle"></i> Lưu</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
@endsection