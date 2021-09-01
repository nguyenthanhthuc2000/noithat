<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'tbl_order_details';

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id');
        
     	// return $this->belongsTo(Product::class);
    }
   

}
