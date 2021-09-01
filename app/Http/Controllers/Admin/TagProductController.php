<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\TagProduct;
use App\Models\Product;
class TagProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TagProducts = TagProduct::orderby('id','DESC')->paginate();
        return view('admin.pages.tagproduct.tagproduct_table')->with(compact('TagProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = 'tag-product-manager.store';
        $id = '';
        return view('admin.pages.tagproduct.tagproduct_form')->with(compact('route','id'));
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
        $tags = TagProduct::orderby('id','DESC')->get();
        foreach ($tags as $key => $tag) {
           if($tag->slug == $data['slug']){
                Session::flash('error','Đường dẩn đã tồn tại!');
                return back();
           }
        }
        if(TagProduct::create($data)){
            Session::flash('success','Thêm thành công!');
        }
        else{
            Session::flash('error','Vui lòng thử lại sau!');
        }
        return Redirect()->route('tag-product-manager.index');
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
        $detail = TagProduct::find($id);
        $route = 'tag-product-manager.update';
        $id = $detail->id;
        return view('admin.pages.tagproduct.tagproduct_form')->with(compact('route','id','detail'));
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
            $update = TagProduct::find($id);
            if($data['checknb']==0){
                $update->noibat =1;
            }else{
                $update->noibat =0;
            }
            $update->save();
            return 1;
        }
        elseif(isset($data['checktt'])){
            $update = TagProduct::find($id);
            if($data['checktt']==0){
                $update->trangthai =1;
            }else{
                $update->trangthai =0;
            }
            $update->save();
            return 1;
        }
        else
        {
            $tags = TagProduct::whereNotin('id',[$id])->orderby('id','DESC')->get();
            foreach ($tags as $key => $tag) {
               if($tag->slug == $data['slug']){
                    Session::flash('error','Đường dẩn đã tồn tại!');
                    return back();
               }
            }
            if(TagProduct::find($id)->update($data)){
                Session::flash('success','Cập nhật thành công!');
            }else{
                Session::flash('error','Vui lòng thử lại sau!');
            }
        }
         return Redirect()->route('tag-product-manager.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id_tag',$id)->get();
        if($product->count() > 0){
             return 0;
        }
        else{
            if(TagProduct::find($id)->delete()){
                return 1;
            }
            else{
                return 2;
            }
        }
    }
}
