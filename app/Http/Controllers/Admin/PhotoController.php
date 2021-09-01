<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\File; 

class PhotoController extends Controller
{
    public function __construct(){
        $this->middleware(['role:admin|photo-seo-manager']);
        $this->middleware('permission:photo',['only' =>['photo','list_photo','edit','update','create','store','destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_photo($type){
        switch ($type) {
            case 'slider':
            $Photos = Photo::where('type',$type)->orderby('id','DESC')->paginate();
                $type = 'slider';
                break;
            case 'criteria':
            $Photos = Photo::where('type',$type)->orderby('id','DESC')->paginate();
                $type = 'criteria';
                break;
            case 'partner':
            $Photos = Photo::where('type',$type)->orderby('id','DESC')->paginate();
                $type = 'partner';
                break;
            case 'album':
            $Photos = Photo::where('type',$type)->orderby('id','DESC')->paginate();
                $type = 'album';
                break;
            default:
                # code...
                break;
        }
        return view('admin.pages.photo.photo_table')->with(compact('type','Photos'));

    }
    public function photo($type){
        $detail= Photo::where('type',$type)->first();
        $id = $detail->id;
         switch ($type) {
            case 'logoheader':
                $route = 'admin/photo-manager/update';
                $type = 'logoheader';
                $motavi = false;
                $title = 'Thông tin hình ảnh Logo Header';
                break;
            case 'logofooter':
                $route = 'admin/photo-manager/update';
                $type = 'logofooter';
                $motavi = true;
                 $title = 'Thông tin hình ảnh Logo Footer';
                break;
            case 'banner':
                $route = 'admin/photo-manager/update';
                $type = 'banner';
                 $title = 'Thông tin hình ảnh Banner';
                $motavi = true;
                break;
            case 'favicon':
                $route = 'admin/photo-manager/update';
                $type = 'favicon';
                 $title = 'Thông tin hình ảnh Favicon';
                $motavi = true;
                break;
            default:
                # code...
                break;
        }
        return view('admin.pages.photo.photo_form')->with(compact('id','type','motavi','route','title','detail'));
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        switch ($type) {
            case 'album':
                $route = 'admin/photo-manager/store';
                $id = '';
                $type = 'album';
                $title = 'Thông tin hình ảnh Ablum';
                $motavi = true;
                break;
            case 'partner':
                $route = 'admin/photo-manager/store';
                $id = '';
                $type = 'partner';
                 $title = 'Thông tin hình ảnh Đối tác';
                $motavi = true;

                break;
            case 'criteria':
                $route = 'admin/photo-manager/store';
                $id = '';
                $type = 'criteria';
                 $title = 'Thông tin hình ảnh Tiêu chí';
                $motavi = true;
                break;
            case 'slider':
                $route = 'admin/photo-manager/store';
                $id = '';
                $type = 'slider';
                 $title = 'Thông tin hình ảnh Slider';
                $motavi = true;
                break;
            
            default:
                # code...
                break;
        }
        return view('admin.pages.photo.photo_form')->with(compact('id','motavi','route','title','type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $insert = new Photo();
        $insert->tenvi = $data['tenvi'];
        $insert->link = $data['link'] ;
        if(isset($insert->motavi)){
            $insert->motavi = $data['motavi'] ;
        }
        $insert->type = $data['type'];
        $file = $request->file('photo');
        if($file){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $old_full_name = $file->getClientOriginalName();
            $ExName = $file->getClientOriginalExtension();
            $name = current(explode('.', $old_full_name));
            $new_full_name = $name.'-'.date("s-i-H").'-'.date("d-m-Y").'.'.$ExName;
            $file->move('public/uploads/photos',$new_full_name);
            $insert->photo = $new_full_name;
        }
        if($insert->save()){
            Session::flash('success','Thêm thành công !');
        }else{
            Session::flash('error','Vui lòng thử lại sau !');
        }
        return redirect('/admin/photo-manager/list/'.$data['type']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail= Photo::where('id',$id)->first();
        $route = 'admin/photo-manager/update';
        $id = $detail->id;
        $type = $detail->type;
        switch ($type) {
            case 'album':
                $title = 'Chỉnh sửa Thông tin hình ảnh Ablum';
                $motavi = true;
                break;
            case 'partner':
                 $title = 'Chỉnh sửa Thông tin hình ảnh Đối tác';
                 $motavi = true;
                break;
            case 'criteria':
                 $title = 'Chỉnh sửa Thông tin hình ảnh Tiêu chí';
                 $motavi = true;
                break;
            case 'slider':
                 $title = 'Chỉnh sửa Thông tin hình ảnh Slider';
                 $motavi = true;
                break;
        };
        return view('admin.pages.photo.photo_form')->with(compact('id','route','motavi','title','type','detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        if(isset($data['checknb'])){
            $update = Photo::where('id',$id)->first();
            if($data['checknb']==0){
                $update->noibat =1;
            }else{
                $update->noibat =0;
            }
            $update->save();
            return 1;
        }
        elseif(isset($data['checkht'])){
            $update = Photo::where('id',$id)->first();
            if($data['checkht']==0){
                $update->hienthi =1;
            }else{
                $update->hienthi =0;
            }
            $update->save();
            return 1;
        }
        else{
            $insert =Photo::where('id',$id)->first();
            $insert->tenvi = $data['tenvi'];
            $insert->link = $data['link'] ;
            if(isset($data['motavi'])){
                $insert->motavi = $data['motavi'] ;
            }
            $insert->type = $data['type'];
            $file = $request->file('photo');
            if($file){
                $image_path = public_path()."/uploads/photos/".$insert->photo;
                if(File::exists($image_path)){
                    File::delete($image_path);
                }
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $old_full_name = $file->getClientOriginalName();
                $ExName = $file->getClientOriginalExtension();
                $name = current(explode('.', $old_full_name));
                $new_full_name = $name.'-'.date("s-i-H").'-'.date("d-m-Y").'.'.$ExName;
                $file->move('public/uploads/photos',$new_full_name);
                $insert->photo = $new_full_name;
            }
            if($insert->save()){
                Session::flash('success','Update thành công !');
            }else{
                Session::flash('error','Vui lòng thử lại sau !');
            }
            if($data['type']=='logoheader' ||$data['type']=='logofooter'|| $data['type']=='banner' || $data['type']=='favicon'){
                return back();
            }
            else{
                return redirect('/admin/photo-manager/list/'.$data['type']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::where('id',$id)->first();
        $image_path = public_path()."/uploads/photos/".$photo->photo;
        // dd($image_path);
        if($photo->delete()){
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            return 1;
        }
    }
}
