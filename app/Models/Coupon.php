<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $perPage = 4;
    protected $table = 'tbl_coupon';
    protected $fillable = ['tenvi','code','motavi','amount','number','status','type','date_end','date_start','used'];
    protected $primaryKey ='id';
}
