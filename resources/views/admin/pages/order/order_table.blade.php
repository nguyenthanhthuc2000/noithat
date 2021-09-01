@extends('admin.layout')
@section('content')
 <!-- col-xl-6 -->

	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<form method="GET" action="{{route('order-manager.index')}}" id="filter_form">
					@csrf
					<div class=" row">
						<div class="col-md-3 col-6" style="display:flex;align-items: center;">
							<label style="margin-right: 5px;">Từ</label>
							<input class="custom-select mb-3" type="date" name="time_start">
						</div>
						<div class="col-md-3 col-6" style="display:flex;align-items: center;">
							<label style="margin-right: 5px;">Đến</label>
							<input class="custom-select mb-3" type="date" name="time_end">
						</div>
						<div class="col-md-3 col-6">
							<input class="custom-select mb-3" type="text" name="order_code" placeholder="Mã hóa đơn...">
						</div>
						<div class="col-md-3 col-6">
							<select class="custom-select mb-3" name="status">
					          <option selected value="">Trạng thái</option>
					          <option value="all">Tất cả</option>
					          <option value="1">Thành công</option>
					          <option value="2">Đã hủy</option>
					          <option value="0">Chờ xử lí</option>
					          <option value="3">Đang xử lí</option>
					        </select>
						</div>
						<div class="col-md-4">
							<button type="submit" class="btn btn-pill btn-danger btn-add"><i class="fas fa-search"></i> Tìm</button>
							<button type="button" class="btn btn-pill btn-primary btn-reset"><i class="fas fa-search-minus"></i> Reset</button>
						</div>
						<div class="col-md-12">
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
				</form>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered ">
					<thead>
						<tr>
							<th >STT</th>
							<th class="center w-100px">Mã hóa đơn</th>
							<th class="center w-300px">Ngày lập hóa đơn</th>
							<th class="center w-100px">Trạng thái</th>
							<th class="center w-300px">Thao tác</th>
						</tr>
					</thead>
					<tbody>
						@foreach($orders as $order)
						<tr>
							<td  class="center">
								1
							</td>
							<td class="center w-100px">
							<p style="text-transform: uppercase;">{{$order->order_code}}</p>
							</td>
							<td class="center w-300px">
								{{$order->created_at}}
							</td>
							<td class="center w-100px">
								@if($order->status == 0)
								<button class="btn btn-pill btn-warning btn__min__width">Chờ xử lí</button>
								@elseif($order->status == 3)
								<button class="btn btn-pill btn-primary btn__min__width">Đang xử lí</button>
								@elseif($order->status == 2)
								<button class="btn btn-pill btn-danger btn__min__width">Đã hủy</button>
								@else($order->status == 1)
								<button class="btn btn-pill btn-success btn__min__width">Thành công</button>
								@endif
							</td>
							<form>
								@csrf
								<td class="center w-100px">
									<button type="button"class="btn btn-primary btn-del-order" data-id="{{$order->id}}"><i class="fas fa-trash-alt"></i></button>
									<a href="{{route('order-manager.edit',$order->id)}}" class="btn btn-success"><i class="far fa-eye"></i></a>
								</td>
							</form>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="paginate-styling">
					{{ $orders->links()}}
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script_function')
	<script type="text/javascript">
		$(document).ready(function(){
			$('.btn-del-order').click(function(){
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
							url:window.route('order-manager.destroy', id),
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
				  					swal("Deleted!", "Chỉ có thể xóa hóa đơn chưa xử lí!", "error");
			                    }
			                }
			            }) 
			        }
			    });
			})
		})
	</script>
@endsection