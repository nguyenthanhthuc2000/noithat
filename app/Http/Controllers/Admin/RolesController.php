<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Hash;
use DB;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function __construct(){
        $this->middleware(['role:admin']);
        $this->middleware('permission:group role',['only' =>['index','edit','update','create','store','destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderby('id','DESC')->get();
        $Roles =  Role::orderby('id','DESC')->get();
        return view('admin.pages.setting.role_table')->with(compact('Roles','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $role = Role::find($data['role']);
        if($role->syncPermissions($data['permission'])){
            Session::flash('success','Cập nhật quyền cho thành công !');
        }else{
            Session::flash('error','Vui lòng thử lại sau !');
        }
        return redirect()->route('roles-manager.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::orderby('id','DESC')->get();
        $get_per_via_roles = DB::table('role_has_permissions')->where('role_id',$role->id)->get();
       return view('admin.pages.setting.permission_for_role_form')->with(compact('permissions','role','get_per_via_roles'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
