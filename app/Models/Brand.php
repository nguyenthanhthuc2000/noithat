<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $perPage = 4;
    protected $table = 'tbl_brand_product';
    protected $fillable = ['tenvi','slug','seo_title','seo_keywords','seo_description'];
    protected $primaryKey ='id';
}
