<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Photo;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\District;
use App\Models\Wards;
use App\Models\CityProvince;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    public function get_address(Request $request){
        $data = $request->all();
        // dd($data);
        if($data['key']){
            $output = '';
            if($data['action'] == 'countrys'){
                $districts = District::where('matp',$data['key'])->get();
                $output.='<option value="">---Chọn Quận/Huyện---</option>';
                foreach($districts as $key => $district){
                    $output.='<option value="'.$district->maqh.'">'.$district->name_quanhuyen.'</option>';
                }
            }
            else{
                $Wards = Wards::where('maqh',$data['key'])->get();
                $output.='<option value="">---Chọn Phường xã/Thị trấn---</option>';
                foreach($Wards as $key => $Ward){
                    $output.='<option value="'.$Ward->xaid.'">'.$Ward->name_xaphuong.'</option>';
                }
            }
             echo $output;
        }
    }
    public function checkout(){
        //
        $CityProvinces = CityProvince::get();
        $Districts = District::get();
        $Wards = Wards::get();
        //
        $setting = Setting::where('id','1')->first();
        $seo_title = $setting->seo_title;
        $seo_description = $setting->seo_title;
        $seo_keywords = $setting->seo_keywords;
        $logo_header =  Photo::where('type','logoheader')->first();
        $logo_footer = Photo::where('type','logofooter')->first();
        $tieuchis = Photo::where('type','criteria')->where('hienthi',1)->get();
        $sliders = Photo::where('type','slider')->where('noibat',1)->where('hienthi',1)->orderby('id','DESC')->get();
        $banner = Photo::where('type','banner')->first();
        $favicon = Photo::where('type','favicon')->first();
        $Categorys = Category::where('type','lv1')->where('trangthai','1')->orderby('id','DESC')->get();
        $Items = Category::where('type','lv2')->where('trangthai','1')->orderby('id','DESC')->get();
        $Brands = Brand::where('trangthai','1')->orderby('id','DESC')->get();
        $servicenbs = Blog::where('hienthi','1')->where('noibat','1')->where('type','service')->orderby('id','DESC')->limit(5)->get();
        $chinhsachs = Blog::where('hienthi','1')->where('noibat','1')->where('type','policy')->orderby('id','DESC')->limit(5)->get();
        return view('client.pages.checkout')->with(compact('setting','seo_keywords','seo_title','seo_description','seo_keywords','sliders','logo_header','logo_footer','favicon','tieuchis','banner','Categorys','Items','Brands','servicenbs','chinhsachs','CityProvinces'));
    }
    public function update_cart(Request $request){
        $carts = session::get('carts');
        if($carts ==true){
            foreach ($request->qty as $key_qty => $qty) {
                foreach ($carts as $key_cart => $cart) {
                    if($cart['session_id'] == $key_qty){
                        $carts[$key_cart]['product_qty'] = $qty;

                    }
                }
            }
             Session::put('carts',$carts);
             Session::flash('success','Cập nhật số lượng thành công!');
             return back();
        }else{
            return back();
        }
    }
    public function destroy_coupon(){
        Session::forget('coupon_session');
        Session::flash('success','Hủy mã giảm giá thành công!');
        return back();
    }
    public function apply_coupon(Request $request){
        $data = $request->all();
       
        $coupon = Coupon::where('code',$data['coupon'])->where('status',1)->first();
        if($coupon == null){
            Session::flash('message','Mã giảm giá không tồn tại!');
        }
        else{
            if($coupon->amount > 0) {
                $coupon_session[] = array(
                    'coupon_code' =>  $coupon->code,    
                    'coupon_type' =>  $coupon->type,
                    'coupon_number' =>  $coupon->number,
                    'coupon_amount' =>  $coupon->amount,
                );
                Session::put('coupon_session',$coupon_session);
                Session::flash('success','Cập nhật mã giảm giá thành công!');
            }
            else{
                 Session::flash('success','Mã đã hết số lượng dùng!');
            }
        }
        return back();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::where('id','1')->first();
        $seo_title = $setting->seo_title;
        $seo_description = $setting->seo_title;
        $seo_keywords = $setting->seo_keywords;
        $logo_header =  Photo::where('type','logoheader')->first();
        $logo_footer = Photo::where('type','logofooter')->first();
        $tieuchis = Photo::where('type','criteria')->where('hienthi',1)->get();
        $sliders = Photo::where('type','slider')->where('noibat',1)->where('hienthi',1)->orderby('id','DESC')->get();
        $banner = Photo::where('type','banner')->first();
        $favicon = Photo::where('type','favicon')->first();
        $Categorys = Category::where('type','lv1')->where('trangthai','1')->orderby('id','DESC')->get();
        $Items = Category::where('type','lv2')->where('trangthai','1')->orderby('id','DESC')->get();
        $Brands = Brand::where('trangthai','1')->orderby('id','DESC')->get();
        $servicenbs = Blog::where('hienthi','1')->where('noibat','1')->where('type','service')->orderby('id','DESC')->limit(5)->get();
        $chinhsachs = Blog::where('hienthi','1')->where('noibat','1')->where('type','policy')->orderby('id','DESC')->limit(5)->get();
        return view('client.pages.cart')->with(compact('setting','seo_keywords','seo_title','seo_description','seo_keywords','sliders','logo_header','logo_footer','favicon','tieuchis','banner','Categorys','Items','Brands','servicenbs','chinhsachs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $product = Product::find($data['id']);
        $session_id = substr(md5(microtime()),rand(0,5), 6);
        // dd($session_id);
        $carts = Session::get('carts'); // lay session cart
        if($carts == true){ //kiem tra ton tai cart chua, neu ton tai roi thi add pro vao
            $is_avaiable = 0; //kiem tra xem co pro do trong session chua, neu co thi update qty k thi tao session cart cho pro do
            foreach ($carts as $key => $cart) {
                if($cart['product_id'] == $product->id){

                    $is_avaiable++;
                    $carts[$key] = array( //cart[$key]  la lay cart dang trong foreach
                        'session_id' => $session_id,
                        'product_id' => $product->id,
                        'product_name' => $product->tenvi,
                        'product_price' => $product->price,
                        'product_price_pro' => $product->price_pro,
                        'product_qty' => $data['cart_product_qty'] + $cart['product_qty'],
                        'product_photo' => $product->photo,
                    );
                   Session::put('carts',$carts);
                    return 1;
                }
            }
            if($is_avaiable == 0){
                 $carts[] = array(
                    'session_id' => $session_id,
                    'product_id' => $product->id,
                    'product_name' => $product->tenvi,
                    'product_price' => $product->price,
                    'product_price_pro' => $product->price_pro,
                    'product_qty' => $data['cart_product_qty'],
                    'product_photo' => $product->photo,
                );
                Session::put('carts',$carts);
                return 1;
            }
        }
        else{//neu chua ton tai thi tao cart session va add pro vao
            $carts[] = array(
                'session_id' => $session_id,
                'product_id' => $product->id,
                'product_name' => $product->tenvi,
                'product_price' => $product->price,
                'product_price_pro' => $product->price_pro,
                'product_qty' => $data['cart_product_qty'],
                'product_photo' => $product->photo,
            );
            Session::put('carts',$carts);
            return 1;
        }

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $carts = Session::get('carts');
        if($carts == true){
            foreach($carts as $key => $cart) {
                if($id == $cart['session_id']){
                    unset($carts[$key]);
                }
            }
            Session::put('carts',$carts);
            return 1;
        }
        else{
             return 0;
        }
    }
}
