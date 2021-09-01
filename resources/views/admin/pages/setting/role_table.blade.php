@extends('admin.layout')
@section('content')
	@include('config')
 <!-- col-xl-6 -->
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class=" row">
					<div class="col-md-6">
						<a href="" class="btn btn-pill btn-success btn-add"><i class="fas fa-plus-circle"></i> Thêm</a>
						<a href="{{route('user-manager.index')}}" class="btn btn-pill btn-danger btn-add"><i class="fas fa-object-group"></i> Users</a>
					</div>
					<div class="col-md-6">
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
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="center">#</th>
							<!-- <th >STT</th> -->
							<th class="center ">Tên nhóm quyền</th>
							<th class="center w-300px">Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1+$Roles->count();?>
						@foreach($Roles as $key => $role)
						<?php $i--; ?>
						<tr>
							<td  class="center">
								{{$i}}
							</td>
							<td class="center w-100px">
								{{$role->tenvi}}
							</td>
							<form>
								@csrf
							<td class="center w-100px">
								<a href="{{route('roles-manager.edit',$role->id)}}" class="btn btn-danger"><i class="far fa-edit"></i></a>
								<a href="" class="btn btn-success"><i class="fas fa-sign-in-alt"></i></a>
							</td>
							</form>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
@section('script_function')
	<script type="text/javascript">
		$(document).ready(function(){
			// $('.status').click(function(){
			// 	const id = $(this).data('id');
			// 	const _token  = $('input[name="_token"]').val();
			// 	let status = 0;
			// 	if(!$(this).prop('checked') ? status=1 : status=0);
			// 	$.ajax({
			// 		url:window.route('user-manager.update', [id]),
			// 		method:'PUT',
			// 		data:{status:status,_token:_token,id:id},
			// 		success:function(data){

			// 		}
			// 	})
			// })
		})
	</script>
@endsection