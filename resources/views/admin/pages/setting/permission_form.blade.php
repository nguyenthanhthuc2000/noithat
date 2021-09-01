@extends('admin.layout')
@section('content')	
@include('config')
	<form action="{{route('user-manager.insert_role_user',$user->id)}}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="container-fluid p-0">
			<div class="title-form">
				<h2 class="h3 mb-3">Cấp vai trò</h2>
				<button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="check-circle"></i> Lưu</button>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							@foreach($roles as $key => $role)
								@if(isset($role_user))
									<label class="custom-control custom-radio">
					                    <input type="radio" name="role"  value="{{$role->name}}" class="custom-control-input status" id="{{$role->id}}" {{$role->id==$role_user->id ? 'checked' : ''}}>
					                    <span class="custom-control-label" for="{{$role->id}}">{{$role->tenvi}}</span>
				                  	</label >
			                  	@else
			                  		<label class="custom-control custom-radio">
					                    <input  type="radio" name="role" value="{{$role->name}}" class="custom-control-input" id="{{$role->id}}">
					                    <span class="custom-control-label" for="{{$role->id}}">{{$role->tenvi}}</span>
				                  	</label >
			                  	@endif
		                  	@endforeach
						</div> 
					</div>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection