<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use HasFactory;
    protected $perPage = 4;
    protected $table = 'tbl_order';
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','customer_id');
    }
    public function shipping()
    {
        return $this->belongsTo('App\Models\Shipping','shipping_id');
    }
    public function scopeTime($query, $request)
    {
        if ($request->has('time_start') && $request->has('time_end') && $request->time_start != '' && $request->time_end != '' ) {
            $query->whereBetween('created_at',[$request->time_start,$request->time_end]);
        }
        elseif($request->has('time_start') && $request->time_start != '' ){
            $query->whereBetween('created_at',[$request->time_start,date("Y-m-d")]);
        }
        elseif($request->has('time_end') && $request->time_end != '' ){
            $query->whereDate('created_at','=',$request->time_end);
        }
        return $query;
    }
    public function scopeOrderCode($query, $request)
    {
        if ($request->has('order_code') && $request->order_code != '') {
            $query->where('order_code', '=', $request->order_code);
        }
        

        return $query;
    }
    public function scopeStatus($query, $request)
    {
        if ($request->has('status') && $request->status != '') {
            if($request->status == 'all'){
                $query;
            }
            else{
                $query->where('status', '=',$request->status);
            }
        }
        return $query;
    }
}
