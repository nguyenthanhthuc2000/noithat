@extends('admin.layout')
@section('content')	
@include('config')
<form>
	@csrf
		<div class="card">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body m-sm-3 m-md-5">
							<div class="row">
								<div class="col-md-6">
									<div class="text-muted">Payment No.</div>
									<strong style="text-transform: uppercase;">Mã HD: {{$order->order_code}}</strong>
								</div>
								<div class="col-md-6 text-md-right">
									<div class="text-muted">Thanh toán khi nhận hàng</div>
									<strong>Ngày đặt hàng: {{$order->created_at}}</strong>
								</div>
							</div>

							<hr class="my-4" />

							<div class="row mb-4">
								<div class="col-md-6">
									<div class="text-muted">Người mua</div>
									<strong>
									  Tên: {{$order->customer->name}}
									</strong>
									<p>
										<a href="tel:{{$order->customer->phone}}">
									    Điện thoại: {{$order->customer->phone}}
									  </a>
										  <br>
										<a href="mailto:{{$order->customer->email}}">
									    Email: {{$order->customer->email}}
									  </a>
									</p>
								</div>
								<div class="col-md-6 text-md-right">
									<div class="text-muted">Người nhận</div>
									<strong>
									  Tên: {{$order->shipping->name}}
									</strong>
									<p>
										Địa chỉ giao hàng: {{$order->shipping->address}}
										<br>
										<a href="tel:{{$order->shipping->phone}}">
									    Điện thoại: {{$order->shipping->phone}}
									  </a>
									  <br>
										<a href="mailto:{{$order->shipping->email}}">
									    Email: {{$order->shipping->email}}
									  </a>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="card">
						<div class="table-responsive">
							<table class="table table-bordered ">
								<thead>
									<tr>
										<th >Mã SP</th>
										<th class="center w-500px">Tên sản phẩm</th>
										<th class="center w-100px">Hình ảnh</th>
										<th class="center w-100px">Số lượng</th>
										<th class="center w-100px">Giá bán</th>
										<th class="center w-100px">Giá Khuyến mãi</th>
										<th class="center w-100px">Tổng</th>
									</tr>
								</thead>
								<tbody>
									<?php $tong = 0; ?>
									@foreach($order_details as $key => $order_detail)
									<tr>

										<td  class="center">
											{{$order_detail->product->id}}
										</td >
										<td class="center">
											{{$order_detail->product->tenvi}}
										</td>
										<td class="center w-200px">
											@if($order_detail->product->photo == '')
											<img class="rounded" src="{{URL::to(IMG404)}}" alt="Placeholder" width="80" height="60">
											@else
											<img class="rounded" src="{{URL::to(IMGPRODUCTS.$order_detail->product->photo)}}" alt="Placeholder" width="80" height="60">
											@endif
										</td>
										<td class="center w-200px">
											{{$order_detail->product_qty}}
										</td>
										<td class="center w-200px">
											@if($order_detail->product->price_pro == 0)
											{{number_format($order_detail->product->price,0,',','.')}}
											@else
											<p style="    text-decoration: line-through; margin: 0;">{{number_format($order_detail->product->price,0,',','.')}}</p>
											@endif
										</td>
										<td class="center w-100px">
											@if($order_detail->product->price_pro == 0)
											---
											@else
											{{number_format($order_detail->product->price_pro,0,',','.')}}
											@endif
										</td>
										<td class="center w-100px">
											<?php $total=0; ?>
											@if($order_detail->product->price_pro == 0)
												<?php $total = $order_detail->product->price * $order_detail->product_qty; ?>
											@else
												<?php $total = $order_detail->product->price_pro * $order_detail->product_qty; ?>
											@endif
											{{number_format($total,0,',','.')}}
											<?php $tong +=$total; ?>
										</td>
									</tr>
									
									@endforeach	
									<tr>
										<td colspan="6">
											Tổng cộng (VNĐ)
										</td>
										<td class="center w-100px">
											{{number_format($tong,0,',','.')}}
										</td>

									</tr>
									@if($Coupons == true)
									<tr>
										<?php $giam = 0; ?>
										<td colspan="5">
											Mã giảm giá {{$Coupons->code}}
										</td>
										<td class="center w-100px">
											@if($Coupons->type == 'phantram')
												-{{$Coupons->number}}%
												<?php 
													$giam = ($tong/100)*$Coupons->number;
												 ?>
											@else
												-{{number_format($Coupons->number,0,',','.')}}
												<?php $giam = $Coupons->number; ?>
											@endif
										</td>
										<td class="center w-100px">
											-{{number_format($giam,0,',','.')}}
										</td>

									</tr>
									@endif
									<tr>
										<?php $tienthue= 0; ?>
										<td colspan="5">
											Thuế (VNĐ)
										</td>
										<td class="center w-100px">
											+{{$thue}}%
											<?php 
												$tienthue = ($tong/100)*$thue;
											 ?>
										</td>
										<td class="center w-100px">
											+{{number_format($tienthue,0,',','.')}}
										</td>

									</tr>
									<tr>
										
										<td colspan="6">
											Phí giao hàng
										</td>
										<td class="center w-100px">
											@if($phigiaohang == 0)
											Miễn phí
											@endif
										</td>

									</tr>
									<tr>
										<td colspan="6">
											Tổng hóa đơn (VNĐ)
										</td>
										<td class="center w-100px">
											@if($Coupons == true)
											{{number_format($tienthue+$tong-$giam,0,',','.')}}
											@else
											{{number_format($tienthue+$tong,0,',','.')}}
											@endif
										</td>

									</tr>
								</tbody>
							</table>
						<div class="card">
							<div class="card-body">
							Trạng thái
								<select class="custom-select mb-3 order_status " id="{{$order->id}}">
									@if($order->status == '1')
									<option  value="1" selected>Thành công</option>
									<option  value="2">Hủy</option>
									@elseif($order->status == '2')
									<option  value="0">Chờ xử lí</option>
									<option  value="2" selected>Hủy</option>
									<option  value="3">Đang xử lí</option>
									@elseif($order->status == '3')
									<option  value="1">Thành công</option>
									<option  value="2">Hủy</option>
									<option  value="3" selected>Đang xử lí</option>
									@elseif($order->status == '0')
									<option  value="0" selected>Chờ xử lí</option>
									<option  value="2">Hủy</option>
									<option  value="3">Đang xử lí</option>
									@endif
						        </select>
							</div>
						</div>
							<div class="text-center">
								<br>
								<p class="text-sm">
									<strong>Lưu ý của khách hàng:</strong> 
										{{$order->shipping->notes}}
								</p>

								<a href="{{route('order-manager.print_order',$order->id)}}" class="btn btn-primary">
						            In hóa đơn
						          </a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</form>
@endsection
@section('script_function')
	<script type="text/javascript">
		$('.order_status').change(function(){
			const status = $(this).val();
			let _token = $('input[name="_token"]').val();
			const id = $(this).attr("id");
			$.ajax({
				url:window.route('order-manager.update',[id]),
				method:'PUT',
				data:{status:status,id:id,_token:_token},
				success:function(data){
					if(data== 1){
						swal("Good job!", "You clicked the button!", "success")
						window.setTimeout(function(){
	  						location.reload();
	  					},2000);
					}
				}
			})
		})
	</script>
@endsection