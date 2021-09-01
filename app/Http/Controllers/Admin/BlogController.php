<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\File; 

class BlogController extends Controller
{
    public function __construct(){
        $this->middleware(['role:admin|censor|articles-manager']);
        $this->middleware('permission:view articles',['only' =>['list_post','update']]);
        $this->middleware('permission:edit articles|create articles|public articles',['only' =>['edit','update','create','store']]);
        $this->middleware('permission:destroy articles',['only' =>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function list_post($type) {
        switch ($type) {
            case 'blog':
                $type="blog";
                $Posts = Blog::where('type','blog')->orderby('id','DESC')->get();
                break;
            case 'policy':
                $type="policy";
                $Posts = Blog::where('type','policy')->orderby('id','DESC')->get();
                break;
            case 'recruiment':
                $type="recruiment";
                $Posts = Blog::where('type','recruiment')->orderby('id','DESC')->get();
                break;
            case 'service':
                $type="service";
                $Posts = Blog::where('type','service')->orderby('id','DESC')->get();
                break;
            default:
                # code...
                break;
        }
        return view('admin.pages.blog.blog_table')->with(compact('Posts','type'));
    }
    public function intro(){
        $route = "admin/blog-manager/update";
        $detail = Blog::where('type','intro')->first();
        $id = $detail->id;
        $type = 'intro';
        return  view('admin.pages.blog.blog_form')->with(compact('route','detail','id','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        switch ($type) {
            case 'blog':
                $type="blog";
                $id = 'blog';
                break;
            case 'policy':
                $type="policy";
                $id = 'policy';
                break;
            case 'recruiment':
                $type="recruiment";
                $id = 'recruiment';
                break;
            case 'service':
                $type="service";
                $id = 'service';
                break;
            default:
                # code...
                break;
        }
        $route = "admin/blog-manager/store";
        return  view('admin.pages.blog.blog_form')->with(compact('type','route','id'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $this->validate($request,
            [
                'tenvi' => 'required|max:250|min:5',
                'slug' => 'required|max:250|min:5',
            ],
            [
                'required' => ':attribute Không được để trống',
                'min' => ':attribute Không được nhỏ hơn :min kí tự',
                'max' => ':attribute Không được lớn hơn :max kí tự',
            ],

            [
                'tenvi' => 'Tiêu đề',
                'slug' => 'Slug',
            ]
        );
        $data = $request->all();
        $insert = new Blog();
        $check_slugs =  Blog::orderby('id','DESC')->get();
        foreach ($check_slugs as $key => $check_slug) {
            if($check_slug->slug == $data['slug']){
                Session::flash('error_slug','Đường dẩn không được trùng');
                return back();
            }
        }
        $insert->tenvi = $data['tenvi'];
        $insert->slug = $data['slug'] ;
        $insert->seo_title = $data['seo_title'] ;
        $insert->seo_keywords = $data['seo_keywords'] ;
        $insert->seo_description = $data['seo_description'] ;
        $insert->motavi = $data['motavi'] ;
        $insert->noidungvi = $data['noidungvi'] ;
        $insert->type = $data['type'] ;
        $file = $request->file('photo');
        if($file){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $old_full_name = $file->getClientOriginalName();
            $ExName = $file->getClientOriginalExtension();
            $name = current(explode('.', $old_full_name));
            $new_full_name = $name.'-'.date("s-i-H").'-'.date("d-m-Y").'.'.$ExName;
            $file->move('public/uploads/blogs',$new_full_name);
            $insert->photo = $new_full_name;
        }
        if($insert->save()){
            Session::flash('success','Thêm thành công !');
        }else{
            Session::flash('error','Vui lòng thử lại sau !');
        }
        return redirect('/admin/blog-manager/list/'.$data['type']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = Blog::where('id',$id)->first();
        $type = $detail->type;
        $id = $detail->id;
        $route = "admin/blog-manager/update";
        return  view('admin.pages.blog.blog_form')->with(compact('type','route','id','detail'));
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
            $update = Blog::where('id',$id)->first();
            if($data['checknb']==0){
                $update->noibat =1;
            }else{
                $update->noibat =0;
            }
            $update->save();
            return 1;
        }
        elseif(isset($data['checkht'])){
            $update = Blog::where('id',$id)->first();
            if($data['checkht']==0){
                $update->hienthi =1;
            }else{
                $update->hienthi =0;
            }
            $update->save();
            return 1;
        }
        else{
           $this->validate($request,
                [
                    'tenvi' => 'required|max:250|min:5',
                    'slug' => 'required|max:250|min:5',
                ],
                [
                    'required' => ':attribute Không được để trống',
                    'min' => ':attribute Không được nhỏ hơn :min kí tự',
                    'max' => ':attribute Không được lớn hơn :max kí tự',
                ],

                [
                    'tenvi' => 'Tiêu đề',
                    'slug' => 'Slug',
                ]
            );
            $update = Blog::where('id',$id)->first();
            $check_slugs =  Blog::whereNotIn('id',[$update->id])->orderby('id','DESC')->get();
            foreach ($check_slugs as $key => $check_slug) {
                if($check_slug->slug == $data['slug']){
                    Session::flash('error_slug','Đường dẩn không được trùng');
                    return back();
                }
            }
            $update->tenvi = $data['tenvi'];
            $update->slug = $data['slug'] ;
            $update->seo_title = $data['seo_title'] ;
            $update->seo_keywords = $data['seo_keywords'] ;
            $update->seo_description = $data['seo_description'] ;
            $update->motavi = $data['motavi'] ;
            $update->noidungvi = $data['noidungvi'] ;
            $update->type = $data['type'] ;
            $file = $request->file('photo');
            if($file){
                $image_path = public_path()."/uploads/blogs/".$update->photo;
                if(File::exists($image_path)){
                    File::delete($image_path);
                }
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $old_full_name = $file->getClientOriginalName();
                $ExName = $file->getClientOriginalExtension();
                $name = current(explode('.', $old_full_name));
                $new_full_name = $name.'-'.date("s-i-H").'-'.date("d-m-Y").'.'.$ExName;
                $file->move('public/uploads/blogs',$new_full_name);
                $update->photo = $new_full_name;
            }
            if($update->save()){
                Session::flash('success','Update thành công !');
            }else{
                Session::flash('error','Vui lòng thử lại sau !');
            }
            return redirect('/admin/blog-manager/list/'.$data['type']);
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
        $blog = Blog::where('id',$id)->first();
        $image_path = public_path()."/uploads/blogs/".$blog->photo;
        // dd($image_path);
        if($blog->delete()){
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            return 1;
        }
    }
}
