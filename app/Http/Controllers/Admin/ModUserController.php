<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class ModUserController extends Controller
{
    public function __construct(){
        $this->middleware(['role:admin']);
        $this->middleware('permission:group role',['only' =>['permission','insert_role_user','index','edit','update','create','store','destroy']]);
    }
    public function permission($id){
         $roles = Role::orderby('id','DESC')->get();
         $user = User::find($id);
         $role_user = $user->roles->first();
         return view('admin.pages.setting.permission_form')->with(compact('user','roles','role_user'));
    }
    public function insert_role_user(Request $request,$id){
        $data = $request->all();
        $user = User::find($id);
        if($user->syncRoles($data['role'])){
            Session::flash('success','Cập nhật quyền cho user thành công !');
        }else{
            Session::flash('error','Vui lòng thử lại sau !');
        }
        return redirect()->route('user-manager.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Users = User::with('roles')->whereNotin('id',['1'])->orderby('id','DESC')->paginate();
        return view('admin.pages.setting.mod_table')->with(compact('Users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $route ='user-manager.store';
        $id='';
        return view('admin.pages.setting.mod_form')->with(compact('route','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $insert = new User();
        $insert->name = $data['name'];
        $insert->phone = $data['phone'];
        $insert->email = $data['email'];
        $insert->address = $data['address'];
        $insert->facebook = $data['facebook'];
        $insert->password = Hash::make('123456789');
        $file = $request->file('photo');
        if($file){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $old_full_name = $file->getClientOriginalName();
            $ExName = $file->getClientOriginalExtension();
            $name = current(explode('.', $old_full_name));
            $new_full_name = $name.'-'.date("s-i-H").'-'.date("d-m-Y").'.'.$ExName;
            $file->move('public/uploads/avatars',$new_full_name);
            $insert->avatar = $new_full_name;
        }
        if($insert->save()){
            Session::flash('success','Thêm thành công !');
        }else{
            Session::flash('error','Vui lòng thử lại sau !');
        }
        return redirect()->route('user-manager.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.pages.setting.mod_form');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = User::where('id',$id)->first();
        $route ='user-manager.update';
        $id = $detail->id;
        return view('admin.pages.setting.mod_form')->with(compact('route','id','detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
         if(isset($data['status'])){
            $update = User::where('id',$id)->first();
            if($data['status']==0){
                $update->status =1;
            }else{
                $update->status =0;
            }
            $update->save();
            return 1;
        }
        else{
            $update = User::where('id',$id)->first();
            $update->name = $data['name'];
            $update->phone = $data['phone'];
            $update->email = $data['email'];
            $update->address = $data['address'];
            $update->facebook = $data['facebook'];
            if($request->hasFile('photo')){
                $file = $request->file('photo');
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $old_full_name = $file->getClientOriginalName();
                $ExName = $file->getClientOriginalExtension();
                $name = current(explode('.', $old_full_name));
                $new_full_name = $name.'-'.date("s-i-H").'-'.date("d-m-Y").'.'.$ExName;
                $file->move('public/uploads/avatars',$new_full_name);
                $update->avatar = $new_full_name;
            }
            if($update->save()){
                Session::flash('success','Update thành công !');
            }else{
                Session::flash('error','Vui lòng thử lại sau !');
            }
            return redirect()->route('user-manager.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = User::where('id',$id)->first();
        if($del->status == 0){
            $del->delete();
            return 1;
        }
        else{
            return 0;
        }
    }
}
