<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    // protected $fillable = ['name','address','address_house','phone','email','notes','method'];
    protected $table = 'tbl_shipping';
    protected $primaryKey ='id';
}
