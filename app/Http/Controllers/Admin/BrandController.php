<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Brand;
class BrandController extends Controller
{
    public function __construct(){
        $this->middleware(['role:admin']);
        $this->middleware('permission:manager brand',['only' =>['index','edit','update','create','store','destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Brands = Brand::orderby('id','DESC')->paginate();
        return view('admin.pages.brand.brand_table')->with(compact('Brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = '';
        $route = 'brand-manager.store';
        return view('admin.pages.brand.brand_form')->with(compact('id','route'));
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
        $slugs = Brand::orderby('id','DESC')->get();
        $check = 0;
        foreach ($slugs as $key => $slug) {
            if($slug->slug == $data['slug']){
                $check++;
                if($check>0){
                    Session::put('error','Đường dẩn không được trùng');
                   return redirect()->route('brand-manager.create'); 
                }
            }
        }
        Brand::create($data);
        return redirect()->route('brand-manager.index');
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
        $detail = Brand::where('id',$id)->first();
        $tenvi = $detail->tenvi;
        $slug = $detail->slug;
        $seo_title = $detail->seo_title;
        $seo_keywords = $detail->seo_keywords;
        $seo_description = $detail->seo_description;
        $route = 'brand-manager.update';
        $id = $detail->id;
        return view('admin.pages.brand.brand_form')->with(compact('tenvi','slug','seo_title','seo_keywords','seo_description','route','id'));
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
            $update = Brand::where('id',$id)->first();
            if($data['checknb']==0){
                $update->noibat =1;
            }else{
                $update->noibat =0;
            }
            $update->save();
            return 1;
        }
        elseif(isset($data['checkht'])){
            $update = Brand::where('id',$id)->first();
            if($data['checkht']==0){
                $update->hienthi =1;
            }else{
                $update->hienthi =0;
            }
            $update->save();
            return 1;
        }
        elseif(isset($data['checktt'])){
            $update = Brand::where('id',$id)->first();
            if($data['checktt']==0){
                $update->trangthai =1;
            }else{
                $update->trangthai =0;
            }
            $update->save();
            return 1;
        }
        else{
           $data = $request->all();
           $slugs = Brand::orderby('id','DESC')->whereNotIn('id',[$id])->get();
                $check = 0;
                foreach ($slugs as $key => $slug) {
                    if($slug->slug == $data['slug']){
                        $check++;
                        if($check>0){
                            Session::put('error','Đường dẩn không được trùng');
                           return redirect()->route('brand-manager.edit',$id); 
                        }
                    }
                }
            Brand::find($id)->update($data);
            return redirect()->route('brand-manager.index');
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
        $del = Brand::where('id',$id)->delete();
        if($del){
            return 1;
        }
    }
}
