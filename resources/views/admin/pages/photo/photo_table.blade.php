@extends('admin.layout')
@section('content')
	@include('config')
 <!-- col-xl-6 -->
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class=" row">
					<div class="col-md-6">
						<a href="{{URL::to('admin/photo-manager/create/'.$type)}}" class="btn btn-pill btn-success btn-add"><i class="fas fa-plus-circle"></i> Thêm</a>
						<a href="" class="btn btn-pill btn-danger btn-add"><i class="far fa-trash-alt"></i> Xóa</a>
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
				<table class="table table-bordered ">
					<thead>
						<tr>
							<th class="center">#</th>
							<!-- <th >STT</th> -->
							<th class="center w-500px">Tên</th>
							<th class="center w-100px">Hình ảnh</th>
							<th class="center w-100px">Nổi bật</th>
							<th class="center w-100px">Hiển thị</th>
							<th class="center w-300px">Thao tác</th>
						</tr>
					</thead>
					<tbody>
						@foreach($Photos as $key => $Photo)
						<tr>
							<td  class="center">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>
							<!--<td  class="center">
								1
							</td> -->
							<td  class="center">
								{{$Photo->tenvi}}
							</td>
							<td class="center w-100px">
								@if($Photo->photo == '')
								<img class="rounded" src="{{URL::to(IMG404)}}" alt="Placeholder" width="80" height="60">
								@else
								<img class="rounded" src="{{URL::to(IMGPHOTOS.$Photo->photo)}}" alt="Placeholder" width="80" height="60">
								@endif
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input checknb" type="checkbox" value="" id="defaultCheck1"  data-id="{{$Photo->id}}" {{ ($Photo->noibat == 1) ? "checked" : '' }}>
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check form-switch">
								  <input class="form-check-input checkht" type="checkbox" id="flexSwitchCheckDefault"  data-id="{{$Photo->id}}" {{ ($Photo->hienthi == 1) ? "checked" : '' }}>
								</div>
							</td>
							<form>
								@csrf
							<td class="center w-100px">
								<a href="{{route('photo-manager.edit',$Photo->id)}}" class="btn btn-danger"><i class="far fa-edit"></i></a>
								<button type="button"class="btn btn-primary btn-del-photo" data-id="{{$Photo->id}}"><i class="fas fa-trash-alt"></i></button>
								<a href="#" class="btn btn-success"><i class="far fa-eye"></i></a>
							</td>
							</form>
						</tr>
						@endforeach
					</tbody>
				</table>
					<div class="paginate-styling">
						{{ $Photos->links()}}
					</div>
			</div>
		</div>
	</div>
@endsection
@section('script_function')
	<script type="text/javascript">
			$('.btn-del-photo').click(function(){
				const id = $(this).data('id');
				const _token  = $('input[name="_token"]').val();
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
							url:window.route('photo-manager.destroy', id),
							method:'POST',
							data:{id:id,_token:_token},
							success:function(data){
								if(data == '1'){
				  					swal("Deleted!", "Xóa thành công.", "success");
				  					window.setTimeout(function(){
				  						location.reload();
				  					},3000);
			                    }
			                }
			            }) 
			        }
			    });
			})
			$('.checknb').click(function(){
				const id = $(this).data('id');
				const _token  = $('input[name="_token"]').val();
				let checknb = 0;
				if(!$(this).prop('checked') ? checknb=1 : checknb=0);
				$.ajax({
					url:window.route('photo-manager.update', [id]),
					method:'POST',
					data:{checknb:checknb,_token:_token,id:id},
					success:function(data){

					}
				})
			})
			$('.checkht').click(function(){
				const id = $(this).data('id');
				const _token  = $('input[name="_token"]').val();
				let checkht = 0;
				if(!$(this).prop('checked') ? checkht=1 : checkht=0);
				$.ajax({
					url:window.route('photo-manager.update', [id]),
					method:'POST',
					data:{checkht:checkht,_token:_token,id:id},
					success:function(data){

					}
				})
			})
		</script>
@endsection
