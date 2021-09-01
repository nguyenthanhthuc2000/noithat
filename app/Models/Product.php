<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;

class Product extends Model
{
    use HasFactory;
    protected $perPage = 8;
    protected $table = 'tbl_product';
    protected $fillable = ['tenvi','slug','seo_title','seo_keywords','seo_description','type','id_cat','id_item','id_brand','luotxem','photo','bosung','kichthuoc','mausac','chatlieu','options','price','price_pro','soluong','daban'];
    protected $primaryKey ='id';

    public function scopeTenvi($query, $request)
    {
        if ($request->has('tenvi') && $request->tenvi != '') {
            $query->where('tenvi', 'LIKE', '%'.$request->tenvi.'%');
        }
        

        return $query;
    }
    public function scopeTrangthai($query, $request)
    {
        if ($request->has('trangthai') && $request->trangthai != '') {
            $query->where('trangthai', '=',$request->trangthai);
        }

        return $query;
    }
    public function scopeCat($query, $request)
    {
        if ($request->has('cat') && $request->cat != '') {
            $query->where('id_cat', '=',$request->cat);
        }

        return $query;
    }
    public function scopeItem($query, $request)
    {
        if ($request->has('item') && $request->item != '') {
            $query->where('id_item', '=',$request->item);
        }

        return $query;
    }
    public function scopeBrand($query, $request)
    {
        if ($request->has('brand') && $request->brand != '') {
            $query->where('id_brand', '=',$request->brand);
        }

        return $query;
    }
    public function scopeMoi($query, $request)
    {
        if ($request->has('moi') && $request->moi == 'on') {
            $query->where('moi', '=',1);
        }

        return $query;
    }
    public function scopeBanchay($query, $request)
    {
        if ($request->has('banchay') && $request->banchay == 'on') {
            $query->where('banchay', '=',1);
        }

        return $query;
    }
    public function scopeNoibat($query, $request)
    {
        if ($request->has('noibat') && $request->noibat == 'on') {
            $query->where('noibat', '=',1);
        }

        return $query;
    }
    public function scopeHienthi($query, $request)
    {
        if ($request->has('hienthi') && $request->hienthi == 'on') {
            $query->where('hienthi', '=',1);
        }

        return $query;
    }
    public function scopeTagProduct($query, $request)
    {
        if ($request->has('id_tag') && $request->id_tag !== '') {
            $query->where('id_tag', '=',$request->id_tag);
        }

        return $query;
    }
}
