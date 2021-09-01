<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'tbl_setting';
    protected $fillable = ['email','direct','open_time','hotline_1','hotline_2','zalo','website','slogan','iframe_google_map','link_fanpage','link_google_map','seo_title','seo_keywords','seo_description'];
    protected $primaryKey ='id';
}
