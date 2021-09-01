<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagProduct extends Model
{
    use HasFactory;
    protected $perPage = 4;
    protected $table = 'tbl_tag_product';
    protected $fillable = ['tenvi','slug','seo_title','seo_keywords','seo_description'];
    protected $primaryKey ='id';
}
