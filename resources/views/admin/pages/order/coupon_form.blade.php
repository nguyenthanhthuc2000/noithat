@extends('admin.layout')
@section('content')
	@include('config')
	<div class="container-fluid p-0">
		<form action="{{route($route,$id)}}"  method="POST" enctype="multipart/form-data">
			@csrf
			@if($id != '')
	        	@method('put')
	        @endif
		<div class="title-form">
			<h2 class="h3 mb-3">Thông tin mã giảm giá</h2>
			<button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="check-circle"></i> Lưu</button>
		</div>
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label class="form-label">Tên mã giảm giá</label>
								<input type="text" class="form-control" name="tenvi"  value="@if(isset($detail)){{$detail->tenvi}}@endif" placeholder="Nhập tên mã giảm giá">
								<span class="error mess-error">{{ $errors->first('tenvi') }}</span>
							</div>
							<div class="form-group">
								<label class="form-label">Mô tả</label>
								<input type="text" class="form-control" name="motavi" value="@if(isset($detail)){{$detail->motavi}}@endif" placeholder="Nhập mô tả mả giảm giá">
							</div>
							<div class="form-group">
								<label class="form-label">Mã giảm giá(max 30 kí tự | min 5 kí tự | Không dấu dính liền)</label>
								<input type="text" class="form-control" name="code" value="@if(isset($detail)){{$detail->code}}@endif" placeholder="Nhập Mã giảm giá">
								@if(Session::get('error_code'))
								<span class="error mess-error">{{Session::get('error_code')}}</span>
								{{session::forget('error_code')}}
								@endif
								<span class="error mess-error">{{ $errors->first('code') }}</span>
							</div>
							<div class="form-group">
								<label class="form-label">Số lượng</label>
								<input type="number" onkeypress="return isNumberKey(event)" class="form-control" name="amount" value="@if(isset($detail)){{$detail->amount}}@endif" placeholder="Số lượng Mã giảm giá">
								<span class="error mess-error">{{ $errors->first('amount') }}</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label for="inputState">Hình thức giảm</label>
								<select id="inputState" class="form-control" name="type">
									@if(isset($detail))
										@if($detail->type=='sotien')
											<option selected value="sotien" >Giảm theo số tiền</option>
											<option value="phantram" >Giảm theo phần trăm</option>
										@else
											<option  value="sotien" >Giảm theo số tiền</option>
											<option selected value="phantram" >Giảm theo phần trăm</option>
										@endif
									@else
										<option value="sotien" >Giảm theo số tiền</option>
										<option value="phantram" >Giảm theo phần trăm</option>
									@endif
								</select>
								<span class="error mess-error">{{ $errors->first('type') }}</span>
							</div>
							<div class="form-group">
								<label class="form-label">Số giảm</label>
								<input type="number" onkeypress="return isNumberKey(event)" class="form-control" name="number" value="@if(isset($detail)){{$detail->number}}@endif" placeholder="Nhập số giảm giá">
								<span class="error mess-error">{{ $errors->first('number') }}</span>
							</div>
							<div class="form-group">
								<label class="form-label">Ngày bắt đầu</label>
								<input type="date" class="form-control" name="date_start" value="@if(isset($detail)){{$detail->date_start}}@endif" placeholder="Nhập Mã giảm giá">
								<span class="error mess-error">{{ $errors->first('date_start') }}</span>
							</div>
							<div class="form-group">
								<label class="form-label">Ngày kết thúc</label>
								<input type="date" class="form-control" name="date_end" value="@if(isset($detail)){{$detail->date_end}}@endif" placeholder="Nhập Mã giảm giá">
								<span class="error mess-error">{{ $errors->first('date_end') }}</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="check-circle"></i> Lưu</button>
		</form>
	</div>
@endsection
@section('script_function')
	<script type="text/javascript">
		$(document).ready(function(){

		})
	</script>
@endsection