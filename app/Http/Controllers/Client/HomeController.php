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
use App\Models\Message;
use Illuminate\Support\Facades\Session;
class HomeController extends Controller
{
    public function post_contact(Request $request){
        $data = $request->all();
         $this->validate($request,
            [
                'name' => 'required|max:35',
                'phone' => 'required',
                'message' => 'required',
            ],
            [
                'required' => ':attribute Không được để trống',
                'min' => ':attribute Không được nhỏ hơn :min kí tự',
                'max' => ':attribute Không được lớn hơn :max kí tự',
            ],

            [
                'name' => 'Họ và tên',
                'phone' => 'Số điện thoại',
                'message' => 'Nội dung',
            ]
        );
         if(Message::create($data)){
            Session::flash('success','Chúng tôi sẽ liên hệ giải đáp tin nhắn của bạn trong thời gian sớm nhất !');
        }else{
            Session::flash('error','Vui lòng thử lại sau !');
        }
        return back();
    }
    public function contact(){
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


        return view('client.pages.contact')->with(compact('setting','seo_keywords','seo_title','seo_description','seo_keywords','sliders','logo_header','logo_footer','favicon','tieuchis','banner','Categorys','Items','Brands','servicenbs','chinhsachs'));
    }
    public function index(){
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
        $getCatNbs = Category::where('type','lv1')->where('trangthai','1')->where('noibat','1')->orderby('id','DESC')->get();
        $getProbcbyCatNbs = Product::where('trangthai','1')->where('banchay','1')->where('hienthi','1')->orderby('id','DESC')->get();
        $getPronbs = Product::where('trangthai','1')->where('noibat','1')->where('hienthi','1')->orderby('id','DESC')->limit(15)->get();
        $getProms = Product::where('trangthai','1')->where('moi','1')->where('hienthi','1')->orderby('id','DESC')->limit(15)->get();
        $baiviets = Blog::where('type','blog')->where('noibat','1')->where('hienthi','1')->get();
        $albums = Photo::where('type','album')->where('noibat',1)->where('hienthi',1)->orderby('id','DESC')->limit(4)->get();
    	// dd($sliders);
    	return view('client.pages.index')->with(compact('setting','seo_keywords','seo_title','seo_description','seo_keywords','sliders','logo_header','logo_footer','favicon','tieuchis','banner','Categorys','Items','Brands','servicenbs','chinhsachs','getProbcbyCatNbs','getCatNbs','getPronbs','getProms','baiviets','albums'));
    }

}
