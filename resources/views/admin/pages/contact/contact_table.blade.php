@extends('admin.layout')
@section('content')
 <!-- col-xl-6 -->
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<form action="{{route('contact-manager.index')}}" method="GET">
					@csrf
					<div class="row box-filter">
						<div class="col-md-6 col-12">
							<input class="form-control form-control-lg mb-3" type="text" name="phone" placeholder="Số điện thoại...">
						</div>
						<div class="col-md-4  col-6">
							<select class="custom-select mb-3" name="status" style="    height: 40px;">
					          <option selected value="">Trạng thái</option>
					          <option value="1">Đã xử lí</option>
					          <option value="0">Chờ xử lí</option>
					        </select>
						</div>
						<div class="col-md-2 col-6">
							<button type="submit" style="    margin-top: -10px;" class="btn btn-pill btn-danger btn-add"><i class="fas fa-search"></i> Tìm</button>
						</div>
					</div>
				</form>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered ">
					<thead>
						<tr>
							<th class="center">#</th>
							<!-- <th >STT</th> -->
							<th class="center w-500px">Tên</th>
							<th class="center w-100px">SĐT</th>
							<th class="center w-100px">Thời gian</th>
							<th class="center w-100px">Trạng thái</th>
							<th class="center w-300px">Thao tác</th>
						</tr>
					</thead>
					<tbody>
						@foreach($Messages as $key => $Message)
						<tr>
							<td  class="center">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>

							<td class="center">
								{{$Message->name}}
							</td>
							<td class="center w-100px">
								{{$Message->phone}}
							</td>
							<td class="center w-100px">
								{{$Message->created_at}}
							</td>
							<td class="center w-100px">
								@if($Message->status == 0)
								<button class="btn btn-pill btn-warning btn__min__width">Chờ xử lí</button>
								@elseif($Message->status == 1)
								<button class="btn btn-pill btn-success btn__min__width">Đã xử lí</button>
								@endif
							</td>
							<form>
								@csrf
								<td class="center w-100px">
									<a href="{{route('contact-manager.show',$Message->id)}}" class="btn btn-info" ><i class="far fa-eye"></i></a>
									<button type="button" data-id="{{$Message->id}}" class="btn btn-danger btn-del-contact" ><i class="fas fa-trash-alt"></i></button>
								</td>
							</form>
						</tr>
						@endforeach
						
					</tbody>

				</table>
				<div class="paginate-styling">
					{{ $Messages->links()}}
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script_function')
	<script type="text/javascript">
		$('.btn-del-contact').click(function(){
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
							url:window.route('contact-manager.destroy', id),
							method:'DELETE',
							data:{id:id,_token:_token},
							success:function(data){
								if(data == '1'){
				  					swal("Deleted!", "Xóa thành công.", "success");
				  					window.setTimeout(function(){
				  						location.reload();
				  					},2000);
			                    }
			                }
			            }) 
			        }
			    });
			})
	</script>
@endsection