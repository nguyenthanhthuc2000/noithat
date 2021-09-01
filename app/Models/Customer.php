<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $perPage = 4;
    protected $table = 'tbl_customer';
    protected $fillable = ['name','email','password','phone'];
    protected $primaryKey ='id';
}
