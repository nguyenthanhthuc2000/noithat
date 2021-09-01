<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $perPage = 4;
    protected $table = 'tbl_category_product';
    protected $fillable = ['tenvi','slug','seo_title','seo_keywords','seo_description','type','id_parent'];
    protected $primaryKey ='id';
}
