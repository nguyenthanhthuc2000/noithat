@extends('admin.layout')
@section('content')
	@include('config')
	<div class="container-fluid p-0">
		<form action="{{route($route,$id)}}" method="POST" enctype="multipart/form-data">
			@csrf
			@if($id != '')
	        	@method('put')
	        @endif
		<div class="title-form">
			<h2 class="h3 mb-3">Thông tin sản phẩm</h2>
			<button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="check-circle"></i> Lưu</button>
		</div>
			<div class="row">
				<div class="col-12 col-xl-8">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label class="form-label">Đường dẩn</label>
								<input type="text" class="form-control" id="convert_slug" value="@if(isset($Detail)){{$Detail->slug}}@endif" name="slug" placeholder="Đường dẩn">
								@if(Session::get('error_slug'))
								<span class="error mess-error">{{Session::get('error_slug')}}</span>
								{{session::forget('error_slug')}}
								@endif
								<span class="error mess-error">{{ $errors->first('slug') }}</span>
							</div>
							<div class="form-group">
								<label class="form-label">Tên sản phẩm</label>
								<input type="text" class="form-control" name="tenvi"onkeyup="ChangeToSlug();" id="slug" placeholder="Nhập tên sản phẩm"  value="@if(isset($Detail)){{$Detail->tenvi}} @endif">
								 <span class="error mess-error">{{ $errors->first('tenvi') }}</span>
								 <div class="invalid-feedback"><em></em> Tên danh mục không được để trống</div>
							</div>
							<div class="form-group">
								<label class="form-label">Mô tả sản phẩm</label>
								<textarea class="form-control" placeholder="Nhập mô tả sản phẩm" rows="3" name="motavi" rows="3">@if(isset($Detail)){{$Detail->motavi}}@endif</textarea>
							</div>
							<div class="form-group">
								<label class="form-label">Nội dung khuyến mãi</label>
								<textarea class="form-control" placeholder="Textarea" id="ckproduct_km" name="noidungkm" rows="4">@if(isset($Detail)){{$Detail->noidungkm}}@endif</textarea>
							</div>
							<div class="form-group">
								<label class="form-label">Nội dung</label>
								<textarea class="form-control" placeholder="Textarea" id="ckproduct_content" name="noidungvi" >@if(isset($Detail)){{$Detail->noidungvi}}@endif</textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-xl-4">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label for="inputState">Danh mục cấp 1</label>
								<select id="inputState" class="form-control choose" name="id_cat">
								 @if(isset($Detail) && $Detail->id_cat != null)
									<option selected value="{{$catbyid->id}}">{{$catbyid->tenvi}}</option>
								@else
								  <option selected value="">Chọn danh mục cấp 1</option>
								@endif
				                @foreach($Categorys as $key => $Category)
				                	<option value="{{$Category->id}}">{{$Category->tenvi}}</option>
				                @endforeach
				               
				              </select>
							</div>
							<div class="form-group">
								<label for="inputState">Danh mục cấp 2</label>
								<select id="item" class="form-control" name="id_item">
				               
				                @if(isset($Detail) && $Detail->id_item != null)
								<option selected value="{{$itembyid->id}}">{{$itembyid->tenvi}}</option>
							  	@foreach($Items as $key => $Item)
				                	<option value="{{$Item->id}}">{{$Item->tenvi}}</option>
				                @endforeach
								@else
								 <option selected value="">Chọn danh mục cấp 2</option>
								@endif
				              
				              </select>
							</div>
							<div class="form-group">
								<label for="inputState">Thương hiệu</label>
								<select id="inputState" class="form-control" name="id_brand">
								
								@if(isset($Detail) && $Detail->id_brand != '')
									<option selected value="{{$brandbyid->id}}">{{$brandbyid->tenvi}}</option>
								@else
								<option selected value="">Chọn thương hiệu</option>
								@endif
				                @foreach($Brands as $key => $Brand)
				                	<option value="{{$Brand->id}}">{{$Brand->tenvi}}</option>
				                @endforeach
				              </select>
							</div>
							<div class="form-group">
								<label for="inputState">Tag sản phẩm</label>
								<select id="inputState" class="form-control" name="id_tag">
								
								@if(isset($Detail) && $Detail->id_tag != '')
									<option selected value="{{$tagbyid->id}}">{{$tagbyid->tenvi}}</option>
								@else
								<option selected value="">Chọn tag sản phẩm</option>
								@endif
				                @foreach($TagProducts as $key => $TagProduct)
				                	<option value="{{$TagProduct->id}}">{{$TagProduct->tenvi}}</option>
				                @endforeach
				              </select>
							</div>
							<div class="form-group">
								<label class="form-label">Giá sản phẩm (VNĐ)</label>
								<input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="price" maxlength="10"  value="@if(isset($Detail)){{$Detail->price}}@endif" placeholder="Giá bán sản phẩm">
							</div>
							<div class="form-group">
								<label class="form-label">Giá khuyến mãi (VNĐ)</label>
								<input type="text" class="form-control" name="price_pro" maxlength="10" onkeypress="return isNumberKey(event)" value="@if(isset($Detail)){{$Detail->price_pro}}@endif"  placeholder="Nhập giá khuyến mãi nếu có">
								@if(Session::get('error'))
								<span class="error mess-error">{{Session::get('error')}}</span>
								{{session::forget('error')}}
								@endif
							</div>
							<div class="form-group">
								<label class="form-label">Số lượng trong kho</label>
								<input type="text" class="form-control" name="soluong" onkeypress="return isNumberKey(event)" value="@if(isset($Detail)){{$Detail->soluong}}@endif" placeholder="Số lượng sản phẩm trong kho">
							</div>
							<div class="form-group">
								<label class="form-label">Chất liệu</label>
								<input type="text" class="form-control" name="chatlieu" value="@if(isset($Detail)){{
								$Detail->chatlieu}}@endif"placeholder="Chất liệu sản phẩm">
							</div>
							<div class="form-group">
								<label class="form-label">Màu sắc</label>
								<input type="text" class="form-control" name="mausac" value="@if(isset($Detail)){{
								$Detail->mausac}}@endif"placeholder="Màu sắc sản phẩm">
							</div>
							<div class="form-group">
								<label class="form-label">Kích thước</label>
								<input type="text" class="form-control" name="kichthuoc" value="@if(isset($Detail)){{
								$Detail->kichthuoc}}@endif"placeholder="Kích thước sản phẩm">
							</div>
							<div class="form-group">
								<label class="form-label">Bổ sung</label>
								<input type="text" class="form-control" name="bosung" value="@if(isset($Detail)){{
								$Detail->bosung}}@endif" placeholder="Bổ sung">
							</div>
							<div class="form-group">
								<label class="form-label">Nơi sản xuất</label>
								<input type="text" class="form-control" name="noisanxuat" value="@if(isset($Detail)){{
								$Detail->noisanxuat}}@endif" placeholder="Nơi sản xuất">
							</div>
							<div class="form-group">
								<label class="form-label w-100">Ảnh đại diện</label>
								<input type="file" id="input_file_img" name="photo" onchange="review_img(event)">
								<small class="form-text text-muted">Yêu cầu kích thước: 500x600px</small>
							</div>
							<div class="review-img">
								@if(isset($Detail) && $Detail->photo != '')
								<img id="review-img" src="{{URL::to(IMGPRODUCTS.$Detail->photo)}}">
								@else
								<img id="review-img" src="{{URL::to(IMG404)}}">
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label class="form-label">Seo title</label>
								<textarea class="form-control" placeholder="Nhập Seo title"  name="seo_title" rows="2">@if(isset($Detail)){{
								$Detail->seo_title}}@endif</textarea>
							</div>
							<div class="form-group">
								<label class="form-label">Seo keywords</label>
								<textarea class="form-control" placeholder="Nhập Seo keywords" rows="2" name="seo_keywords" >@if(isset($Detail)){{
								$Detail->seo_keywords}}@endif</textarea>
							</div>
							<div class="form-group">
								<label class="form-label">Seo description</label>
								<textarea class="form-control" placeholder="Seo description" rows="2" name="seo_description">@if(isset($Detail)){{
								$Detail->seo_description}}@endif</textarea>
							</div>
							<button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="check-circle"></i> Lưu</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
@endsection
@section('script_function')
	<script type="text/javascript">
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
