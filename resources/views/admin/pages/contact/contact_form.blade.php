@extends('admin.layout')
@section('content')	
@include('config')
	<form action="" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="container-fluid p-0">
			<div class="title-form">
				<h2 class="h3 mb-3">Thông tin bài viết</h2>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label class="form-label">Nội dung</label>
								<textarea class="form-control" placeholder="Textarea" disabled="" rows="8"  name="noidungvi" >{{$Messages->message}}</textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label class="form-label">Tên khách hàng</label>
								<input type="text" class="form-control"disabled="" value="{{$Messages->name}}" placeholder="Tên khách hàng">
							</div>
							<div class="form-group">
								<label class="form-label">Số điện thoại</label>
								<input type="text" class="form-control" disabled=""placeholder="Nhập tên bài viết"  value="{{$Messages->phone}}">
							</div>
							<div class="form-group">
								<label class="form-label">Email</label>
								<input type="text" class="form-control" disabled=""placeholder="Nhập tên bài viết"  value="{{$Messages->email}}">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
			Trạng thái
				<select class="custom-select mb-3 contact_status " id="{{$Messages->id}}">
					@if($Messages->status == '1')
					<option  value="0">Chờ xử lí</option>
					<option  value="1"  selected>Đã xử lí</option>
					@else
					<option  value="0" selected>Chờ xử lí</option>
					<option  value="1" >Đã xử lí</option>
					@endif
		        </select>
			</div>
		</div>
	</form>
@endsection
@section('script_function')
	<script type="text/javascript">
		$('.contact_status').change(function(){
			const status = $(this).val();
			let _token = $('input[name="_token"]').val();
			const id = $(this).attr("id");
			$.ajax({
				url:window.route('contact-manager.update',[id]),
				method:'PUT',
				data:{status:status,id:id,_token:_token},
				success:function(data){
					if(data== 1){
						swal("Good job!", "Cập nhật thành công!", "success")
						window.setTimeout(function(){
	  						location.reload();
	  					},2000);
					}
				}
			})
		})
	</script>
@endsection