
  <script src="{{asset('public/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('public/admin/js/app.js')}}"></script>
  <script src="{{asset('public/admin/ckeditor/ckeditor.js')}}"></script>
  <script src="{{asset('public/admin/js/my-script.js')}}"></script>
  <script src="{{asset('public/vendor/js/sweetalert.js')}}"></script>
  @yield('script_function')
  <script type="text/javascript">
  	CKEDITOR.replace('ckproduct_content',{
      filebrowserImageUploadUrl : "{{ url('admin/upload-manager/uploads-ckeditor?_token='.csrf_token()) }}",
      filebrowserBrowseUrl : "{{ url('admin/upload-manager/file/file-browser?_token='.csrf_token()) }}",
      filebrowserUploadMethod : 'form'
  });
	CKEDITOR.replace('ckproduct_desc');
  CKEDITOR.replace('ckproduct_km');
  CKEDITOR.config.entities = false; //khong bi loi font k insert
  </script>