@extends('admin.layout')
@section('content')
	@include('config')
 <!-- col-xl-6 -->
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<form method="GET" action="{{route('product-manager.index')}}" id="filter_form">
					@csrf
					<div class=" row">
						<div class="col-md-3 col-6">
							<select class="custom-select mb-3 " name="brand">
					          <option selected value="">Thương hiệu</option>
					          @foreach($Brands as $Brand)
					          <option value="{{$Brand->id}}">{{$Brand->tenvi}}</option>
					          @endforeach
					        </select>
						</div>
						<div class="col-md-3 col-6">
							<select class="custom-select mb-3 choose" name="cat">
					          <option selected value="">Danh mục cấp 1</option>
					          @foreach($Categorys as $Category)
					          <option value="{{$Category->id}}">{{$Category->tenvi}}</option>
					          @endforeach
					        </select>
						</div>
						<div class="col-md-3 col-6">
							<select class="custom-select mb-3" name="item" id="item">
					          <option selected value="">Danh mục cấp 2</option>
					        </select>
						</div>
						<div class="col-md-3 col-6">
							<select class="custom-select mb-3" name="trangthai">
					          <option selected value="">Trạng thái</option>
					          <option value="1">Hoạt động</option>
					          <option value="0">Ngưng hoạt động</option>
					        </select>
						</div>
						<div class="col-md-3 col-6">
							<select class="custom-select mb-3" name="id_tag">
					          <option selected value="">Tag sản phẩm</option>
					          @foreach($TagProducts as $key  => $TagProduct)
					          <option value="{{$TagProduct->id}}">{{$TagProduct->tenvi}}</option>
					          @endforeach
					        </select>
						</div>
						<div class="col-md-2 col-6">
							<label class="custom-control custom-checkbox">
					          <input type="checkbox" name="moi"class="custom-control-input">
					          <span class="custom-control-label">Sản phẩm mới</span>
					        </label>				
						</div>
						<div class="col-md-2 col-6">
							<label class="custom-control custom-checkbox">
					          <input type="checkbox" name="banchay"class="custom-control-input">
					          <span class="custom-control-label">Bán chạy</span>
					        </label>				
						</div>
						<div class="col-md-2 col-6">
							<label class="custom-control custom-checkbox">
					          <input type="checkbox" name="noibat"class="custom-control-input">
					          <span class="custom-control-label">Nổi bật</span>
					        </label>				
						</div>
						<div class="col-md-2 col-6">
							<label class="custom-control custom-checkbox">
					          <input type="checkbox" name="hienthi"class="custom-control-input">
					          <span class="custom-control-label">Hiển thị</span>
					        </label>				
						</div>
						<div class="col-md-6 col-12">
							<input class="form-control form-control-lg mb-3" type="text" name="tenvi" placeholder="Tìm kiếm...">
						</div>
						<div class="col-md-6">
							<button type="submit" class="btn btn-pill btn-danger btn-add"><i class="fas fa-search"></i> Tìm</button>
							<a href="{{route('product-manager.index')}}" class="btn btn-pill btn-primary "><i class="fas fa-search-minus"></i> Reset</a>
							@can('create product')
							<a href="{{route('product-manager.create')}}" class="btn btn-pill btn-success btn-add"><i class="fas fa-plus-circle"></i> Thêm</a>
							@endcan
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
							<th class="center">Mã</th>
							<!-- <th >STT</th> -->
							<th class="center w-500px">Tên</th>
							<th class="center w-100px">Hình ảnh</th>
							@can('public product')
							<th class="center w-100px">Mới</th>
							<th class="center w-100px">Bán chạy</th>
							<th class="center w-100px">Nổi bật</th>
							<th class="center w-100px">Hiển thị</th>
							<th class="center w-100px">Trạng thái</th>
							@endcan
							<th class="center w-300px">Thao tác</th>
						</tr>
					</thead>
					<tbody>
						@foreach($Products as $key => $Product)
						<tr>
							<td  class="center">
								{{$Product->id}}
							</td>
							<td>
								{{$Product->tenvi}}
							</td>
							<td class="center w-100px">
								@if($Product->photo == '')
								<img class="rounded" src="{{URL::to(IMG404)}}" alt="Placeholder" width="80" height="60">
								@else
								<img class="rounded" src="{{URL::to(IMGPRODUCTS.$Product->photo)}}" alt="Placeholder" width="80" height="60">
								@endif
							</td>
							@can('public product')
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input checkmoi" type="checkbox" value="" id="defaultCheck1"  data-id="{{$Product->id}}" {{ ($Product->moi == 1) ? "checked" : '' }}>
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input checkbc" type="checkbox" value="" id="defaultCheck1"  data-id="{{$Product->id}}" {{ ($Product->banchay == 1) ? "checked" : '' }}>
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input checknb" type="checkbox" value="" id="defaultCheck1"  data-id="{{$Product->id}}" {{ ($Product->noibat == 1) ? "checked" : '' }}>
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input checkht" type="checkbox" value="" id="defaultCheck1"  data-id="{{$Product->id}}" {{ ($Product->hienthi == 1) ? "checked" : '' }}>
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check form-switch">
								  <input class="form-check-input checktt" type="checkbox" id="flexSwitchCheckDefault"  data-id="{{$Product->id}}" {{ ($Product->trangthai == 1) ? "checked" : '' }}>
								</div>
							</td>
							@endcan
							<form>
								@csrf
							<td class="center w-100px">
								@can('edit product')
								<a href="{{route('product-manager.edit',$Product->id)}}" class="btn btn-danger"><i class="far fa-edit"></i></a>
								@endcan
								@can('destroy product')
									<button type="button"class="btn btn-primary btn-del-product" data-id="{{$Product->id}}"><i class="fas fa-trash-alt"></i></button>
								@endcan
								<a href="{{route('chi-tiet-san-pham.show',$Product->slug)}}" class="btn btn-info" target="_blank"><i class="far fa-eye"></i></a>
							</td>
							</form>
						</tr>
						@endforeach
					</tbody>
				</table>
					<div class="paginate-styling">
						{{ $Products->links()}}
					</div>
			</div>
		</div>
	</div>
@endsection
@section('script_function')
	<script type="text/javascript">

			$('.btn-del-product').click(function(){
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
							url:window.route('product-manager.destroy', id),
							method:'DELETE',
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
					url:window.route('product-manager.update', [id]),
					method:'PUT',
					data:{checknb:checknb,_token:_token,id:id},
					success:function(data){

					}
				})
			})
			$('.checkmoi').click(function(){
				const id = $(this).data('id');
				const _token  = $('input[name="_token"]').val();
				let checkmoi = 0;
				if(!$(this).prop('checked') ? checkmoi=1 : checkmoi=0);
				$.ajax({
					url:window.route('product-manager.update', [id]),
					method:'PUT',
					data:{checkmoi:checkmoi,_token:_token,id:id},
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
					url:window.route('product-manager.update', [id]),
					method:'PUT',
					data:{checkht:checkht,_token:_token,id:id},
					success:function(data){

					}
				})
			})
			$('.checktt').click(function(){
				const id = $(this).data('id');
				const _token  = $('input[name="_token"]').val();
				let checktt = 0;
				if(!$(this).prop('checked') ? checktt=1 : checktt=0);
				$.ajax({
					url:window.route('product-manager.update', [id]),
					method:'PUT',
					data:{checktt:checktt,_token:_token,id:id},
					success:function(data){

					}
				})
			})
			$('.checkbc').click(function(){
				const id = $(this).data('id');
				const _token  = $('input[name="_token"]').val();
				let checkbc = 0;
				if(!$(this).prop('checked') ? checkbc=1 : checkbc=0);
				$.ajax({
					url:window.route('product-manager.update', [id]),
					method:'PUT',
					data:{checkbc:checkbc,_token:_token,id:id},
					success:function(data){

					}
				})
			})
			$('.choose').on('change',function(){
				let id_cat = $(this).val();
				let _token = $('input[name="_token"]').val();
				// alert(id_cat)
				$.ajax({
					url: '{{route("product-manager.choose_cat")}}',
					method: 'POST',
					data:{id_cat:id_cat,_token:_token},
					success:function(data){
						$('#item').html(data);
					}
				})
			})
		</script>
@endsection
