@extends('admin.layout')
@section('content')
 <!-- col-xl-6 -->
@include('config')
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class=" row">
					<div class="col-md-6">
						@can('create articles')
						<a href="{{URL::to('admin/blog-manager/create/'.$type)}}" class="btn btn-pill btn-success btn-add"><i class="fas fa-plus-circle"></i> Thêm</a>
						@endcan
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
							@can('public articles')
							<th class="center w-100px">Nổi bật</th>
							<th class="center w-100px">Hiển thị</th>
							@endcan
							<th class="center w-300px">Thao tác</th>
						</tr>
					</thead>
					<tbody>
						@foreach($Posts as $key => $Post)
						<tr>
							<td  class="center">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>
							<td>
								{{$Post->tenvi}}
							</td>
							<td class="center w-100px">
								@if($Post->photo != '')
								<img id="review-img"  width="80" height="60" src="{{URL::to(IMGBLOG.$Post->photo)}}">
								@else
								<img id="review-img" width="80" height="60" src="{{URL::to(IMG404)}}">
								@endif
							</td>
							@can('public articles')
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input checknb" type="checkbox" value="" id="defaultCheck1" data-id="{{$Post->id}}" {{ ($Post->noibat == 1) ? "checked" : '' }}>
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check form-switch">
								  <input class="form-check-input checkht" type="checkbox" id="flexSwitchCheckDefault" data-id="{{$Post->id}}" {{ ($Post->hienthi == 1) ? "checked" : '' }}>
								</div>
							</td>
							@endcan
							<form>
								@csrf
								<td class="center w-100px">
									@can('edit articles')
									<a href="{{URL::to('admin/blog-manager/edit/'.$Post->id)}}" class="btn btn-danger"><i class="far fa-edit"></i></a>
									@endcan
									@can('destroy articles')
									<button type="button" class="btn btn-primary btn-del-blog" data-id="{{$Post->id}}"><i class="fas fa-trash-alt"></i></button>
									@endcan
									<a href="#" class="btn btn-success"><i class="far fa-eye"></i></a>
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
			 $('.btn-del-blog').click(function(){
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
							 url:window.route('blog-manager.destroy', id),
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
					url:window.route('blog-manager.update', [id]),
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
					url:window.route('blog-manager.update', [id]),
					method:'POST',
					data:{checkht:checkht,_token:_token,id:id},
					success:function(data){

					}
				})
			})
		</script>
@endsection
