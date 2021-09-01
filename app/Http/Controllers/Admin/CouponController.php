<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function __construct(){
        $this->middleware(['role:admin']);
        $this->middleware('permission:coupon',['only' =>['index','edit','update','create','store','destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Coupons = Coupon::orderby('id','DESC')->get();
        return view('admin.pages.order.coupon_table')->with(compact('Coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = 'coupon-manager.store';
        $id = '';
        return view('admin.pages.order.coupon_form')->with(compact('route','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,
            [
                'tenvi' => 'required|max:250|min:5',
                'code' => 'required|max:29|min:3',
                'amount' => 'required',
                'date_end' => 'required',
                'date_start' => 'required',
                'number' => 'required',
                'type' => 'required',
            ],
            [
                'required' => ':attribute Không được để trống',
                'min' => ':attribute Không được nhỏ hơn :min kí tự',
                'max' => ':attribute Không được lớn hơn :max kí tự',
            ],

            [
                'tenvi' => 'Tiêu đề',
                'code' => 'Code',
                'amount' => 'Số lượng',
                'date_end' => 'Ngày kết thúc',
                'date_start' => 'Ngày bắt đầu',
                'type' => 'Hình thức giảm',
                'number' => 'Số tiền giảm',
            ]
        );
        $data = $request->all();
        $check_codes =  Coupon::orderby('id','DESC')->get();
        foreach ($check_codes as $key => $check_code) {
            if($check_code->code == $data['code']){
                Session::flash('error_code','Mã này đã tồn tại');
                return back();
            }
        }
        if(Coupon::create($data)){
            Session::flash('success','Thêm thành công !');
        }else{
            Session::flash('error','Vui lòng thử lại sau !');
        }
        return Redirect()->route('coupon-manager.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $route = 'coupon-manager.update';
        $detail = Coupon::find($id);
        $id = $detail->id;
        return view('admin.pages.order.coupon_form')->with(compact('route','id','detail'));
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
         if(isset($data['checktt'])){
            $update = Coupon::find($id);
            if($data['checktt']==0){
                $update->status =1;
            }else{
                $update->status =0;
            }
            $update->save();
            return 1;
        }
        else{
            $this->validate($request,
                [
                    'tenvi' => 'required|max:250|min:5',
                    'code' => 'required|max:29|min:3',
                    'amount' => 'required',
                    'date_end' => 'required',
                    'date_start' => 'required',
                    'number' => 'required',
                    'type' => 'required',
                ],
                [
                    'required' => ':attribute Không được để trống',
                    'min' => ':attribute Không được nhỏ hơn :min kí tự',
                    'max' => ':attribute Không được lớn hơn :max kí tự',
                ],

                [
                    'tenvi' => 'Tiêu đề',
                    'code' => 'Code',
                    'amount' => 'Số lượng',
                    'date_end' => 'Ngày kết thúc',
                    'date_start' => 'Ngày bắt đầu',
                    'type' => 'Hình thức giảm',
                    'number' => 'Số tiền giảm',
                ]
            );
            $check_codes =  Coupon::whereNotin('id',[$id])->orderby('id','DESC')->get();
            foreach ($check_codes as $key => $check_code) {
                if($check_code->code == $data['code']){
                    Session::flash('error_code','Mã ' .$data['code'] .' đã tồn tại');
                    return back();
                }
            }
            if(Coupon::find($id)->update($data)){
                Session::flash('success','Update thành công !');
            }else{
                Session::flash('error','Vui lòng thử lại sau !');
            }
            return Redirect()->route('coupon-manager.index');
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
        $del = Coupon::where('id',$id)->first();
        if($del->status == 0){
            $del->delete();
            return 1;
        }
        else{
            return 0;
        }
    }
}
