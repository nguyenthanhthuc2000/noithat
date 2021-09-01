@extends('admin.layout')
@section('content')
 <!-- col-xl-6 -->

	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class=" row">
					<div class="col-md-6">
						<a href="{{route('coupon-manager.create')}}" class="btn btn-pill btn-success btn-add"><i class="fas fa-plus-circle"></i> Thêm</a>
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
							<th >STT</th>
							<th class="center w-500px">Tên</th>
							<th class="center w-100px">Code</th>
							<th class="center w-100px">Số lượng</th>
							<th class="center w-100px">Đã dùng</th>
							<th class="center w-100px">Hình thức giảm</th>
							<th class="center w-100px">Giảm</th>
							<th class="center w-100px">Ngày bắt đầu</th>
							<th class="center w-100px">Ngày kết thúc</th>
							<th class="center w-100px">Trạng thái</th>
							<th class="center w-300px">Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; ?>
						@foreach($Coupons as $Coupon)
						<?php $i++; ?>
						<tr>
							<td  class="center">
								{{$i}}
							</td >
							<td class="center">
								{{$Coupon->tenvi}}
							</td>
							<td class="center w-200px">
								{{$Coupon->code}}
							</td>
							<td class="center w-200px">
								{{$Coupon->amount}}
							</td>
							<td class="center w-200px">
								{{$Coupon->used}}
							</td>
							<td class="center w-200px">
								@if($Coupon->type=='sotien')
									Giảm theo giá tiền
								@else
									Giảm theo %
								@endif
							</td>
							<td class="center w-200px">
								
								@if($Coupon->type=='sotien')
									{{number_format($Coupon->number,0,',','.')}} vnđ
								@else
									{{$Coupon->number}}%
								@endif
							</td>
							<td class="center w-200px">
								{{$Coupon->date_start}}
							</td>
							<td class="center w-200px">
								{{$Coupon->date_end}}
							</td>
							<td class="center w-100px">
								<div class="form-check form-switch">
								  <input class="form-check-input status checktt" data-id="{{$Coupon->id}}" type="checkbox" data-id=""{{ ($Coupon->status == 1) ? "checked" : '' }}>
								</div>
							</td>
							<form>
								@csrf
							<td class="center w-100px">
								<a href="{{route('coupon-manager.edit',$Coupon->id)}}" class="btn btn-danger"><i class="far fa-edit"></i></a>
								<button type="button" class="btn btn-primary btn-del-coupon" data-id="{{$Coupon->id}}"><i class="fas fa-trash-alt"></i></button>
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
			$('.btn-del-coupon').click(function(){
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
							url:window.route('coupon-manager.destroy', id),
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
				  					swal("Deleted!", "Mã đang hoạt động không thể xóa!", "error");
			                    }
			                }
			            }) 
			        }
			    });
			})
			$('.checktt').click(function(){
				const id = $(this).data('id');
				const _token  = $('input[name="_token"]').val();
				let checktt = 0;
				if(!$(this).prop('checked') ? checktt=1 : checktt=0);
				$.ajax({
					url:window.route('coupon-manager.update', [id]),
					method:'PUT',
					data:{checktt:checktt,_token:_token,id:id},
					success:function(data){

					}
				})
			})
		})
	</script>
@endsection