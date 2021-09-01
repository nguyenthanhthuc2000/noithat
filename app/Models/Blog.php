<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $perPage = 4;
    protected $table = 'tbl_blog';
    protected $fillable = ['id_tag','tenvi','slug','motavi','noidungvi','photo','type','hienthi','noibat','seo_title','seo_keywords','seo_description'];
    protected $primaryKey ='id';
}
