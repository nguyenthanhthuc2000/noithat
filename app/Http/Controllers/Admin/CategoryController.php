<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{

    public function __construct(){
        $this->middleware(['role:admin']);
        $this->middleware('permission:manager category',['only' =>['index','edit','update','create','store','destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categorys = Category::orderby('id','DESC')->where('type','lv1')->paginate();
        return view('admin.pages.category.category_table')->with(compact('Categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = '';
        $route = 'category-manager.store';
        return view('admin.pages.category.category_form')->with(compact('route','id'));
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
        $slugs = Category::orderby('id','DESC')->get();
        $check = 0;
        foreach ($slugs as $key => $slug) {
            if($slug->slug == $data['slug']){
                $check++;
                if($check>0){
                    Session::put('error','Đường dẩn không được trùng');
                   return redirect()->route('category-manager.create'); 
                }
            }
        }
        Category::create($data);
        return redirect()->route('category-manager.index');
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
        $detail = Category::where('id',$id)->first();
        $tenvi = $detail->tenvi;
        $slug = $detail->slug;
        $seo_title = $detail->seo_title;
        $seo_keywords = $detail->seo_keywords;
        $seo_description = $detail->seo_description;
        $route = 'category-manager.update';
        $id = $detail->id;
        return view('admin.pages.category.category_form')->with(compact('tenvi','slug','seo_title','seo_keywords','seo_description','route','id'));
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
            $update = Category::where('id',$id)->first();
            if($data['checknb']==0){
                $update->noibat =1;
            }else{
                $update->noibat =0;
            }
            $update->save();
            return 1;
        }
        elseif(isset($data['checkht'])){
            $update = Category::where('id',$id)->first();
            if($data['checkht']==0){
                $update->hienthi =1;
            }else{
                $update->hienthi =0;
            }
            $update->save();
            return 1;
        }
        elseif(isset($data['checktt'])){
            $update = Category::where('id',$id)->first();
            if($data['checktt']==0){
                $update->trangthai =1;
            }else{
                $update->trangthai =0;
            }
            $update->save();
            return 1;
        }
        else{
            $slugs = Category::orderby('id','DESC')->whereNotIn('id',[$id])->get();
            $check = 0;
            foreach ($slugs as $key => $slug) {
                if($slug->slug == $data['slug']){
                    $check++;
                    if($check>0){
                        Session::put('error','Đường dẩn không được trùng');
                       return redirect()->route('category-manager.edit',$id); 
                    }
                }
            }
            Category::find($id)->update($data);
            return redirect()->route('category-manager.index');
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
        if($id){
          $checkitem = Category::where('id_parent',$id)->get();
           if($checkitem->count() >0){
                return 0;   
           }else{
               $del = Category::where('id',$id)->delete();
               if($del){
                return 1;
               }
           }
        }
    }
}
