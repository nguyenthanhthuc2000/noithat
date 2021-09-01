@extends('admin.layout')
@section('content')	
@include('config')
	<form action="{{route('roles-manager.store')}}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="container-fluid p-0">
			<div class="title-form">
				<input type="hidden" name="role" value="{{$role->id}}">
				<h2 class="mb-3">Cấp quyền cho vai trò {{$role->tenvi}}</h2>
				<button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="check-circle"></i> Lưu</button>
			</div>
			<div class="card">
				<div class="card-body">
					<div class="row">
						<h4 class="">Nhóm quyền bài viết</h4>
						@foreach($permissions as $key => $per)
							@if($per->group_per == 'articles')
								<div class="col-md-4">
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" name="permission[]" data-name="{{$per->name}}" data-id="{{$per->id}}" value="{{$per->id}}" id="flexCheckDefault"
									  @foreach($get_per_via_roles as $key => $get_per_via_role)
									  	@if($get_per_via_role->permission_id == $per->id)
									  		checked
									  	@endif
									  @endforeach
									  >
									  <label class="form-check-label" for="{{$per->id}}">
									    {{$per->tenvi}}
									  </label>
									</div>
								</div>
							@endif
						@endforeach
						<br><br>
						<h4 class="">Nhóm quyền sản phẩm</h4>
						@foreach($permissions as $key => $per)
							@if($per->group_per == 'products')
								<div class="col-md-4">
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" name="permission[]" data-name="{{$per->name}}" data-id="{{$per->id}}" value="{{ $per->id}}" id="flexCheckDefault"
									   @foreach($get_per_via_roles as $key => $get_per_via_role)
									  	@if($get_per_via_role->permission_id == $per->id)
									  		checked
									  	@endif
									  @endforeach
									  >
									  <label class="form-check-label" for="{{$per->id}}">
									    {{$per->tenvi}}
									  </label>
									</div>
								</div>
							@endif
						@endforeach
						<br><br>
						<h4 class="">Nhóm quyền hóa đơn</h4>
						@foreach($permissions as $key => $per)
							@if($per->group_per == 'order')
								<div class="col-md-4">
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" name="permission[]" data-name="{{ $per->name}}" data-id="{{$per->id}}" value="{{ $per->id}}" id="flexCheckDefault"
									   @foreach($get_per_via_roles as $key => $get_per_via_role)
									  	@if($get_per_via_role->permission_id == $per->id)
									  		checked
									  	@endif
									  @endforeach
									  >
									  <label class="form-check-label" for="{{$per->id}}">
									    {{$per->tenvi}}
									  </label>
									</div>
								</div>
							@endif
						@endforeach
						<br><br>
						<h4 class="">Nhóm quyền admin</h4>
						@foreach($permissions as $key => $per)
							@if($per->group_per == 'admin')
								<div class="col-md-4">
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" name="permission[]" data-name="{{ $per->name}}" data-id="{{$per->id}}" value="{{ $per->id}}" id="flexCheckDefault"
									   @foreach($get_per_via_roles as $key => $get_per_via_role)
									  	@if($get_per_via_role->permission_id == $per->id)
									  		checked
									  	@endif
									  @endforeach
									  >
									  <label class="form-check-label" for="{{$per->id}}">
									    {{$per->tenvi}}
									  </label>
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection