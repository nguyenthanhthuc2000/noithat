<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
class LoginController extends Controller
{
    public function index(){
    	// echo bcrypt('123456');
    	return view('admin.login');
    }
    public function postLogin(Request $Request){
    	$arr = [
    		'email'=>$Request->email,
    		 'password'=>$Request->password,
    		];
    	if(Auth::attempt($arr)){
            $name = Auth::user('id');
    		if($name->status == '1'){
                // Session::put('admin_avatar',$name->avatar);
    			// Session::put('admin_id',$name->id);
    			// Session::put('admin_name',$name->name);
    			return redirect()->route('admin.index');
    		}
    		else{
	    		Session::put('message','Tài khoản đã bị khóa');
				return redirect()->route('admin.login');
    		}
    	}
    	else{
    		Session::put('message','Sai tài khoản hoặc mật khẩu');
			return redirect()->route('admin.login');
    	}
    } 
    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect()->route('admin.login');
    }
}
