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
use App\Models\Customer;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{

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

        // content
        // dd($sliders);
        return view('client.pages.login')->with(compact('setting','seo_keywords','seo_title','seo_description','seo_keywords','sliders','logo_header','logo_footer','favicon','tieuchis','banner','Categorys','Items','Brands','servicenbs','chinhsachs'));
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $customer = Customer::where('phone',$data['phone'])->first();
        if($customer){
            if (password_verify($data['password'], $customer->password)) {
                 Session::put('user_name',$customer->name);
                 Session::put('user_id',$customer->id);
                return Redirect()->route('shop.index');
            }
            else{
                Session::flash('error_login','Sai tài khoản hoặc mật khẩu');
                return back();
            }
        }
        else{
            Session::flash('error_login','Sai tài khoản hoặc mật khẩu');
            return back();
        }
    }
    public function logout()
    {
        Session::flush();
        return Redirect()->route('shop.index');
    }

  
}
