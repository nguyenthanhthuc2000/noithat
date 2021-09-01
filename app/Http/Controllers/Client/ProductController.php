<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Photo;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\TagProduct;
use App\Models\Blog;
use Illuminate\Support\Facades\Session;
class ProductController extends Controller
{
    public function tag($tag){
        //content
        $tag = TagProduct::where('slug',$tag)->first();
        $products = Product::where('id_tag',$tag->id)->where('hienthi','1')->where('trangthai','1')->orderby('id','DESC')->paginate(8);
        $title = $tag->tenvi;
        //
        $setting = Setting::where('id','1')->first();
        $seo_title = $tag->seo_title;
        $seo_description = $tag->seo_title;
        $seo_keywords = $tag->seo_keywords;
        $logo_header =  Photo::where('type','logoheader')->first();
        $logo_footer = Photo::where('type','logofooter')->first();
        $tieuchis = Photo::where('type','criteria')->where('hienthi',1)->get();
        $sliders = Photo::where('type','slider')->where('noibat',1)->where('hienthi',1)->orderby('id','DESC')->get();
        $banner = Photo::where('type','banner')->first();
        $favicon = Photo::where('type','favicon')->first();
        $Categorys = Category::where('type','lv1')->where('trangthai','1')->orderby('id','DESC')->get();
        $Items = Category::where('type','lv2')->where('trangthai','1')->orderby('id','DESC')->get();
        $Brands = Brand::where('trangthai','1')->orderby('id','DESC')->get();
        $servicenbs = Blog::where('hienthi','1')->where('noibat','1')->where('type','service')->orderby('id','DESC')->get();
         $chinhsachs = Blog::where('hienthi','1')->where('noibat','1')->where('type','policy')->orderby('id','DESC')->limit(5)->get();

        return view('client.pages.product')->with(compact('setting','seo_keywords','seo_title','seo_description','seo_keywords','sliders','logo_header','logo_footer','favicon','tieuchis','banner','Categorys','Items','Brands','servicenbs','chinhsachs','products','title'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //content
        $getDetailPro = Product::where('slug',$id)->first();
        $getTagProducts = TagProduct::orderby('id','DESC')->get();
        //
        $setting = Setting::where('id','1')->first();
        $seo_title = $getDetailPro->seo_title;
        $seo_description = $getDetailPro->seo_title;
        $seo_keywords = $getDetailPro->seo_keywords;
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


        return view('client.pages.detail_product')->with(compact('setting','seo_keywords','seo_title','seo_description','seo_keywords','sliders','logo_header','logo_footer','favicon','tieuchis','banner','Categorys','Items','Brands','servicenbs','chinhsachs','getDetailPro','getTagProducts'));
    }

}
