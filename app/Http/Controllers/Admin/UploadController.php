<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
     public function file_browser(Request $request){
        $paths = glob(public_path('uploads/ckeditor/*'));
        $fileNames = array();
        foreach($paths as $path){
            array_push($fileNames,basename($path));
        }
        $data = array(
            'fileNames' => $fileNames
        );
        return view('admin.pages.image.file_browser')->with($data);
    }
    public function uploads_ckeditor(Request $request){
        if($request->hasFile('upload')){
            $originName = $request->file('upload')->getClientOriginalName();
            $extension = $request->file('upload')->extension();
            $file_name = pathinfo($originName, PATHINFO_FILENAME);
            $new_filename = $file_name.'-'.date("s-i-H").'-'.date("d-m-Y").'.'.$extension;
            $request->file('upload')->move('public/uploads/ckeditor',$new_filename);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/uploads/ckeditor/'.$new_filename);
            // $msg ='Tải ảnh thành công';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
        // echo'ok';
    }
}
