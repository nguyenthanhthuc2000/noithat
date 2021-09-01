<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;


class Message extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','phone','message'];
    protected $table = 'tbl_message';
    protected $perPage = 4;
    public function scopePhone($query, $request)
    {
    	if($request->has('phone') && $request->phone != ''){
        	$query->where('phone','like', '%'.$request->phone.'%');
    	}
    	return $query;
    }
    public function scopeStatus($query, $request)
    {
    	if($request->has('status') && $request->status != ''){
        	$query->where('status','=', $request->status);
    	}
    	return $query;
    }
}	
