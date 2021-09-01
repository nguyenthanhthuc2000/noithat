<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
class NotificationController extends Controller
{

    public function __construct(){
        $this->middleware(['role:admin']);
    }
    public function index($type)
    {
        switch ($type) {
            case 'mod':
                $detail = Notification::where('type','mod')->first();    
                $tieude = 'mod';
                break;
            case 'nguoi-dung':
                $detail = Notification::where('type','nguoi-dung')->first();                    
                $tieude = 'người dùng';
                break;
            default:
                # code...
                break;
        }
        return view('admin.pages.setting.notification_form')->with(compact('detail','tieude'));
    }

  
    public function update(Request $request, $id)
    {
        $data = $request->all();
        if(Notification::find($id)->update($data)){
            return back();
        }
    }

}
