@extends('admin.layout')
@section('content')
      <form action="{{route('setting-manager.update',1)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="container-fluid p-0">
          <div class="title-form">
          <h2 class="h3 mb-3">Cấu hình chung</h2>
          <button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="check-circle"></i> Lưu</button>
        </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Email</label>
                          <input type="email" name="email" class="form-control" id="inputEmail4" value="{{$setting->email}}" placeholder="Email">
                        </div>
                        <div class="form-group col-md-6">
                          <label class="form-label">Địa chỉ</label>
                        <input type="text" name="direct"class="form-control"  value="{{$setting->direct}}" placeholder="Địa chỉ">
                        </div>
                      </div>
                       <div class="form-row">
                        <div class="form-group col-md-6">
                          <label class="form-label">Slogan</label>
                          <input type="text"name="slogan" class="form-control" value="{{$setting->slogan}}" placeholder="Slogan">
                        </div>
                        <div class="form-group col-md-6">
                             <label class="form-label">Website</label>
                          <input type="text" name="website"class="form-control" value="{{$setting->website}}" placeholder="Website">
                        </div>
                      </div>
                       <div class="form-row">
                        <div class="form-group col-md-6">
                          <label class="form-label">Youtube</label>
                          <input type="text"name="youtube" class="form-control"  placeholder="Youtube">
                        </div>
                        <div class="form-group col-md-6">
                          <label class="form-label">Thời gian hoạt động</label>
                          <input type="text" name="open_time"class="form-control" value="{{$setting->open_time}}" placeholder="Thời gian hoạt động">
                        </div>
                      </div>
                       <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="form-label">Zalo</label>
                            <input type="text" name="zalo"class="form-control" value="{{$setting->zalo}}" placeholder="Zalo">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Điện thoại 1</label>
                            <input type="text"name="hotline_1" class="form-control" value="{{$setting->hotline_1}}" placeholder="Điện thoại 1">
                        </div>
                        <div class="form-group col-md-4">
                          <label class="form-label">Điện thoại 2</label>
                          <input type="text" name="hotline_2"class="form-control" value="{{$setting->hotline_2}}" placeholder="Điện thoại 2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputAddress">Link Fanpage</label>
                        <input type="text" name="link_fanpage"class="form-control" id="inputAddress" value="{{$setting->link_fanpage}}" placeholder="Link Fanpage">
                      </div>
                      <div class="form-group">
                        <label for="inputAddress2">Link Google Map</label>
                        <input type="text"name="link_google_map" class="form-control" id="inputAddress2" value="{{$setting->link_google_map}}" placeholder="Link Google Map">
                      </div>
                      <div class="form-group">
                        <label for="inputAddress2">Iframe Google Map</label>
                        <input type="text" name="iframe_google_map"class="form-control"  value="{{$setting->iframe_google_map}}" placeholder="Iframe Google Map">
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                      <div class="form-group">
                        <label for="inputAddress2">Seo title</label>
                        <input type="text"name="seo_title" class="form-control" id="inputAddress2" value="{{$setting->seo_title}}" placeholder="Seo title">
                      </div>
                      <div class="form-group">
                        <label for="inputAddress2">Seo keywords</label>
                         <textarea type="text"name="seo_keywords" class="form-control" id="inputAddress2" rows="3" placeholder="Seo keywords">{{$setting->seo_keywords}}</textarea> 
                      </div>
                       <div class="form-group">
                        <label for="inputAddress2">Seo description</label>
                        <textarea type="text" name="seo_description"class="form-control" id="inputAddress2" rows="3" placeholder="Seo description">{{$setting->seo_description}}</textarea> 
                      </div>
                       <button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="check-circle"></i> Lưu</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </form>
@endsection