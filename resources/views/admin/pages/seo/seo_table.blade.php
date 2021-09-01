@extends('admin.layout')
@section('content')
 <!-- col-xl-6 -->

	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<a href="{{route('product-manager.create')}}" class="btn btn-pill btn-success btn-add"><i class="fas fa-plus-circle"></i> Thêm</a>
				<a href="" class="btn btn-pill btn-danger btn-add"><i class="far fa-trash-alt"></i> Xóa</a>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered ">
					<thead>
						<tr>
							<th >STT</th>
							<th class="center w-500px">Tên</th>
							<th class="center w-100px">Hình ảnh</th>
							<th class="center w-100px">Bán chạy</th>
							<th class="center w-100px">Nổi bật</th>
							<th class="center w-100px">Hiển thị</th>
							<th class="center w-100px">Trạng thái</th>
							<th class="center w-300px">Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								1
							</td>
							<td>
								The first approach uses bootstrap offset class
							</td>
							<td class="center w-100px">
								<img class="rounded" src="{{URL::to('public/admin/img/avatars/avatar-5.jpg')}}" alt="Placeholder" width="80" height="60">
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check form-switch">
								  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
								</div>
							</td>
							<td class="center w-100px">
								<a href="#" class="btn btn-danger"><i class="far fa-edit"></i></a>
								<button class="btn btn-primary"><i class="fas fa-trash-alt"></i></button>
								<a href="#" class="btn btn-success"><i class="far fa-eye"></i></a>
							</td>
						</tr>
						<tr>
							<td>
								1
							</td>
							<td>
								The first approach uses bootstrap offset class
							</td>
							<td class="center w-100px">
								<img class="rounded" src="{{URL::to('public/admin/img/avatars/avatar-5.jpg')}}" alt="Placeholder" width="80" height="60">
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check form-switch">
								  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
								</div>
							</td>
							<td class="center w-100px">
								<a href="#" class="btn btn-danger"><i class="far fa-edit"></i></a>
								<button class="btn btn-primary"><i class="fas fa-trash-alt"></i></button>
								<a href="#" class="btn btn-success"><i class="far fa-eye"></i></a>
							</td>
						</tr>
						<tr>
							<td>
								1
							</td>
							<td>
								The first approach uses bootstrap offset class
							</td>
							<td class="center w-100px">
								<img class="rounded" src="{{URL::to('public/admin/img/avatars/avatar-5.jpg')}}" alt="Placeholder" width="80" height="60">
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check form-switch">
								  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
								</div>
							</td>
							<td class="center w-100px">
								<a href="#" class="btn btn-danger"><i class="far fa-edit"></i></a>
								<button class="btn btn-primary"><i class="fas fa-trash-alt"></i></button>
								<a href="#" class="btn btn-success"><i class="far fa-eye"></i></a>
							</td>
						</tr>
						<tr>
							<td>
								1
							</td>
							<td>
								The first approach uses bootstrap offset class
							</td>
							<td class="center w-100px">
								<img class="rounded" src="{{URL::to('public/admin/img/avatars/avatar-5.jpg')}}" alt="Placeholder" width="80" height="60">
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
								</div>
							</td>
							<td class="center w-100px">
								<div class="form-check form-switch">
								  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
								</div>
							</td>
							<td class="center w-100px">
								<a href="#" class="btn btn-danger"><i class="far fa-edit"></i></a>
								<button class="btn btn-primary"><i class="fas fa-trash-alt"></i></button>
								<a href="#" class="btn btn-success"><i class="far fa-eye"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection