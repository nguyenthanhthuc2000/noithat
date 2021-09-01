<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\TagProduct;
use Illuminate\Support\Facades\File; 
class ProductController extends Controller
{

    public function __construct(){
        $this->middleware(['role:admin|product-manager|censor|order-manager','permission:view product']);
        $this->middleware('permission:edit product|create product|public product',['only' =>['edit','update','create','store']]);
        $this->middleware('permission:destroy product',['only' =>['destroy']]);
    }
    //loc san pham
    


    //end filter product
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $Products =  Product::Tenvi($request)->Trangthai($request)->Cat($request)->Moi($request)->Noibat($request)->Banchay($request)->Hienthi($request)->TagProduct($request)->Item($request)->Brand($request)->orderby('id','DESC')->paginate();
        $Products->appends(['tenvi' => $request->tenvi]);
        $Products->appends(['trangthai' => $request->trangthai]);
        $Products->appends(['id_cat' => $request->cat]);
        $Products->appends(['id_item' => $request->item]);
        $Products->appends(['id_brand' => $request->brand]);
        $Products->appends(['moi' => $request->moi]);
        $Products->appends(['banchay' => $request->banchay]);
        $Products->appends(['hienthi' => $request->hienthi]);
        $Products->appends(['noibat' => $request->noibat]);
        $Products->appends(['id_tag' => $request->id_tag]);
        $Categorys = Category::where('type','lv1')->where('trangthai','1')->orderby('id','DESC')->get();
        $Items = Category::where('type','lv2')->where('trangthai','1')->orderby('id','DESC')->get();
        $Brands = Brand::where('trangthai','1')->orderby('id','DESC')->get();
        $TagProducts = TagProduct::where('trangthai','1')->orderby('id','DESC')->get();
        return view('admin.pages.product.product_table')->with(compact('Products','Categorys','Items','Brands','TagProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Categorys = Category::where('type','lv1')->where('trangthai','1')->orderby('id','DESC')->get();
        $Items = Category::where('type','lv2')->where('trangthai','1')->orderby('id','DESC')->get();
        $Brands = Brand::where('trangthai','1')->orderby('id','DESC')->get();
        $TagProducts = TagProduct::where('trangthai','1')->orderby('id','DESC')->get();
        $id= '';
        $route = 'product-manager.store';
        return view('admin.pages.product.product_form')->with(compact('id','route','Categorys','Items','Brands','TagProducts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $insert = new Product();
        $check_slugs =  Product::orderby('id','DESC')->get();
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
        $insert->noidungkm = $data['noidungkm'] ;
        $insert->bosung = $data['bosung'];
        $insert->type ='san-pham';
        $insert->id_cat = $data['id_cat'];
        $insert->id_item = $data['id_item'];
        $insert->id_brand = $data['id_brand'];
        $insert->id_tag = $data['id_tag'];
        $insert->chatlieu = $data['chatlieu'];
        $insert->noisanxuat = $data['noisanxuat'];
        $insert->mausac = $data['mausac'];
        $insert->kichthuoc = $data['kichthuoc'];
        $insert->bosung = $data['bosung'];
        $insert->type ='san-pham';
        if($data['price'] == null){
             $insert->price = 0;
        }
        else{
            if($data['price_pro'] != null){
                if($data['price'] < $data['price_pro']){
                    Session::flash('error','Giá khuyến mãi không được lớn hơn giá bán');
                    return back();
                }
            }
            else{
                $price_pro = str_replace(',','', $data['price_pro']);
                $insert->price_pro = $price_pro;
            }
            $price = str_replace(',','', $data['price']);
            $insert->price = $price;
        }
        if($data['soluong'] == null){
             $insert->soluong = 0;
        }
        else{
            $insert->soluong = $data['soluong'] ;
        }
        $file = $request->file('photo');
        if($file){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $old_full_name = $file->getClientOriginalName();
            $ExName = $file->getClientOriginalExtension();
            $name = current(explode('.', $old_full_name));
            $new_full_name = $name.'-'.date("s-i-H").'-'.date("d-m-Y").'.'.$ExName;
            $file->move('public/uploads/products',$new_full_name);
            $insert->photo = $new_full_name;
        }

        if($insert->save()){
            Session::flash('success','Thêm thành công !');
        }else{
            Session::flash('error','Vui lòng thử lại sau !');
        }
        return Redirect()->route('product-manager.index');
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
        $Detail = Product::where('id',$id)->first();
        if($Detail->id_tag != ''){
            $TagProducts = TagProduct::whereNotin('id',[$Detail->id_tag])->where('trangthai','1')->orderby('id','DESC')->get();
        }
        else{
            $TagProducts = TagProduct::where('trangthai','1')->orderby('id','DESC')->get();
        }
        $Categorys = Category::where('type','lv1')->where('trangthai','1')->whereNotIn('id',[$Detail->id_cat])->orderby('id','DESC')->get();
        if($Detail->id_cat != ''){
            $Categorys = Category::where('type','lv1')->where('trangthai','1')->whereNotIn('id',[$Detail->id_cat])->orderby('id','DESC')->get();
        }
        else{
            $Categorys = Category::where('type','lv1')->where('trangthai','1')->orderby('id','DESC')->get();
        }
        if($Detail->id_cat != ''){
            $Items = Category::where('type','lv2')->where('id_parent',$Detail->id_cat)->where('trangthai','1')->whereNotIn('id',[$Detail->id_item])->orderby('id','DESC')->get();
        }
        else{
            $Items = Category::where('type','lv2')->where('trangthai','1')->whereNotIn('id',[$Detail->id_item])->orderby('id','DESC')->get();
        }
        if($Detail->id_brand != ''){
            $Brands = Brand::where('trangthai','1')->whereNotIn('id',[$Detail->id_brand])->orderby('id','DESC')->get();
        }
        else{
            $Brands = Brand::where('trangthai','1')->orderby('id','DESC')->get();
        }
        $catbyid = Category::where('id',$Detail->id_cat)->first();
        $itembyid =  Category::where('id',$Detail->id_item)->first();
        $brandbyid = Brand::where('id',$Detail->id_brand)->first();
        $tagbyid = TagPRoduct::where('id',$Detail->id_tag)->first();
        $id= $Detail->id;
        $route = 'product-manager.update';
        return view('admin.pages.product.product_form')->with(compact('id','route','Categorys','Items','Brands','Detail','catbyid','itembyid','brandbyid','tagbyid','TagProducts'));
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
            $update = Product::where('id',$id)->first();
            if($data['checknb']==0){
                $update->noibat =1;
            }else{
                $update->noibat =0;
            }
            $update->save();
            return 1;
        }
        elseif(isset($data['checkht'])){
            $update = Product::where('id',$id)->first();
            if($data['checkht']==0){
                $update->hienthi =1;
            }else{
                $update->hienthi =0;
            }
            $update->save();
            return 1;
        }
        elseif(isset($data['checkmoi'])){
            $update = Product::where('id',$id)->first();
            if($data['checkmoi']==0){
                $update->moi =1;
            }else{
                $update->moi =0;
            }
            $update->save();
            return 1;
        }
        elseif(isset($data['checktt'])){
            $update = Product::where('id',$id)->first();
            if($data['checktt']==0){
                $update->trangthai =1;
            }else{
                $update->trangthai =0;
            }
            $update->save();
            return 1;
        }
         elseif(isset($data['checkbc'])){
            $update = Product::where('id',$id)->first();
            if($data['checkbc']==0){
                $update->banchay =1;
            }else{
                $update->banchay =0;
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
            $insert = Product::where('id',$id)->first();
            $check_slugs =  Product::orderby('id','DESC')->whereNotIn('id',[$insert->id])->get();
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
            $insert->noidungkm = $data['noidungkm'] ;
            $insert->bosung = $data['bosung'];
            $insert->id_cat = $data['id_cat'];
            $insert->id_item = $data['id_item'];
            $insert->id_brand = $data['id_brand'];
            $insert->id_tag = $data['id_tag'];
            $insert->chatlieu = $data['chatlieu'];
            $insert->noisanxuat = $data['noisanxuat'];
            $insert->mausac = $data['mausac'];
            $insert->kichthuoc = $data['kichthuoc'];
            $insert->bosung = $data['bosung'];
            $insert->type ='san-pham';
            if($data['price'] == null){
                 $insert->price = 0;
            }
            else{
                if($data['price_pro'] != null){
                    if( str_replace('.','',$data['price']) < str_replace('.','',$data['price_pro'])){
                        Session::flash('error','Giá khuyến mãi không được lớn hơn giá bán');
                        return back();
                    }
                    else{
                        $insert->price_pro = str_replace('.','',$data['price_pro']);
                    }
                }
                $insert->price = str_replace('.','',$data['price']);
            }
            if($data['soluong'] == null){
                 $insert->soluong = 0;
            }
            else{
                $insert->soluong = $data['soluong'] ;
            }
            $file = $request->file('photo');
            if($file){
                $image_path = public_path()."/uploads/products/".$insert->photo;
                if(File::exists($image_path)){
                    File::delete($image_path);
                }
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $old_full_name = $file->getClientOriginalName();
                $ExName = $file->getClientOriginalExtension();
                $name = current(explode('.', $old_full_name));
                $new_full_name = $name.'-'.date("s-i-H").'-'.date("d-m-Y").'.'.$ExName;
                $file->move('public/uploads/products',$new_full_name);
                $insert->photo = $new_full_name;
            }

            if($insert->save()){
                Session::flash('success','Update sản phẩm thành công !');
            }else{
                Session::flash('error','Vui lòng thử lại sau !');
            }
            return Redirect()->route('product-manager.index');
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
        $product = Product::where('id',$id)->first();
        $image_path = public_path()."/uploads/products/".$product->photo;
           if($product->delete()){
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            return 1;
        }
    }
    public function choose_cat(Request $request){
        if($request->id_cat){
            $cats = Category::where('id_parent',$request->id_cat)->where('trangthai','1')->get();
            $ouput = "";
                $ouput.='<option selected value="">Chọn danh mục cấp 2</option>"';
            foreach ($cats as $key => $cat) {
                $ouput.='<option value="'.$cat->id.'">'.$cat->tenvi.'</option>"';
            }
        }
        return $ouput;
    }
}
