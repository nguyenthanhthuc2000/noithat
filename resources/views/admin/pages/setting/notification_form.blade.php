@extends('admin.layout')
@section('content')	
@include('config')
	<form action="{{route('notification-manager.update',$detail)}}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="container-fluid p-0">
			<div class="title-form">
				<h2 class="h3 mb-3">Thông báo dành cho {{$tieude}}</h2>
				<button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="check-circle"></i> Lưu</button>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label class="form-label">Nội dung</label>
								<textarea class="form-control" placeholder="Textarea" id="ckproduct_content" name="noidungvi" >@if(isset($detail)){{$detail->noidungvi}}@endif</textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection