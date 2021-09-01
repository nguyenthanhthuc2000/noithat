@extends('admin.layout')
@section('content')
	@include('config')
 <!-- col-xl-6 -->
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class=" row">
					<div class="col-md-6">
						<a href="{{route('user-manager.create')}}" class="btn btn-pill btn-success btn-add"><i class="fas fa-plus-circle"></i> Thêm</a>
						<a href="{{route('roles-manager.index')}}" class="btn btn-pill btn-danger btn-add"><i class="fas fa-object-group"></i> Roles</a>
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
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th class="center">#</th>
							<!-- <th >STT</th> -->
							<th class="center w-500px">Tên User</th>
							<th class="center w-100px">Email</th>
							<th class="center w-100px">Phone</th>
							<th class="center min-with-200">Vai trò</th>
							<th class="center min-with-400">Quyền</th>
							<th class="center w-100px">Trạng thái</th>
							<th class="center w-300px">Thao tác</th>
						</tr>
					</thead>
					<tbody>
						@foreach($Users as $key => $u)
						<tr>
							<td  class="center">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>
							<td class="center w-100px">
								{{$u->name}}
							</td>
							<td class="center w-100px">
								{{$u->email}}
							</td>
							<td class="center w-100px">
								{{$u->phone}}
							</td>
							<td class="center min-with-200">
								@foreach($u->roles as $role)
									{{$role->tenvi}}
								@endforeach
							</td>
							<td class="center min-with-400">
								@if(isset($role->permissions))
									@foreach($role->permissions as $permission)
										<span class="btn btn-primary tag-role">{{$permission->tenvi}}</span>
									@endforeach
								@else
									Chưa cập nhật
								@endif
							</td>
							<td class="center w-100px">
								<div class="form-check form-switch">
								  <input class="form-check-input status" data-id="{{$u->id}}" type="checkbox" id="" data-id="{{$u->id}}" {{ ($u->status == 1) ? "checked" : '' }}>
								</div>
							</td>
							<form>
								@csrf
							<td class="center w-100px">
								<a href="{{route('user-manager.permission',$u->id)}}" class="btn btn-primary"><i class="fas fa-cog"></i></i></a>
								<a href="{{route('user-manager.edit',$u->id)}}" class="btn btn-warning"><i class="far fa-edit"></i></a>
								<!-- <a href="#" class="btn btn-success"><i class="fas fa-sign-in-alt"></i></a> -->
								<button type="button" class="btn btn-danger btn-del-mod" data-id="{{$u->id}}"><i class="fas fa-trash"></i></button>
							</td>
							</form>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
				<div class="paginate-styling">
					{{ $Users->links()}}
				</div>
		</div>
	</div>
@endsection
@section('script_function')
	<script type="text/javascript">
		$(document).ready(function(){
			$('.status').click(function(){
				const id = $(this).data('id');
				const _token  = $('input[name="_token"]').val();
				let status = 0;
				if(!$(this).prop('checked') ? status=1 : status=0);
				$.ajax({
					url:window.route('user-manager.update', [id]),
					method:'PUT',
					data:{status:status,_token:_token,id:id},
					success:function(data){

					}
				})
			})
			$('.btn-del-mod').click(function(){
				const id = $(this).data('id');
				const _token  = $('input[name="_token"]').val();
				// alert(_token)
				swal({
					  title: "Bạn có chắc chắn xóa",
					  text: "Sau khi xóa không thể khôi phục nhé",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonClass: "btn-danger",
					  confirmButtonText: "Yes, xóa",
					  closeOnConfirm: false,
				},
			    function(isConfirm){
			        if(isConfirm){
			            $.ajax({
							url:window.route('user-manager.destroy', id),
							method:'DELETE',
							data:{id:id,_token:_token},
							success:function(data){
								if(data == '1'){
				  					swal("Deleted!", "Xóa thành công.", "success");
				  					window.setTimeout(function(){
				  						location.reload();
				  					},3000);
			                    }
			                    else if(data == '0'){
				  					swal("Deleted!", "Không thể xóa tài khoản đang hoạt động !", "error");
			                    }
			                }
			            }) 
			        }
			    });
			})
		})
	</script>
@endsection