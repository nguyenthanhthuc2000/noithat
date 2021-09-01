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
use Illuminate\Support\Facades\Session;
class BlogController extends Controller
{
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
        $getDetailBlog = Blog::where('slug',$id)->first();
        $lienquans = Blog::where('type',$getDetailBlog->type)->whereNotIn('id',[$getDetailBlog->id])->where('hienthi','1')->limit(5)->get();
        //
        $setting = Setting::where('id','1')->first();
        $seo_title = $getDetailBlog->seo_title;
        $seo_description = $getDetailBlog->seo_title;
        $seo_keywords = $getDetailBlog->seo_keywords;
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

        return view('client.pages.detail_blog')->with(compact('setting','seo_keywords','seo_title','seo_description','seo_keywords','sliders','logo_header','logo_footer','favicon','tieuchis','banner','Categorys','Items','Brands','servicenbs','getDetailBlog','lienquans','chinhsachs'));
    }
}
