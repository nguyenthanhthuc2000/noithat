<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\Coupon;
use PDF;
class OrderController extends Controller
{

    public function __construct(){
        $this->middleware(['role:admin|order-manager|censor']);
    }
    //key: dompdf laravel
    public function print_order($id){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->order_convert_pdf($id));
        return $pdf->stream();
    }
    public function order_convert_pdf($id){
        $order =  Order::with('customer')->with('shipping')->where('id',$id)->first();
        $order_details = OrderDetail::with('product')->where('order_code',$order->order_code)->get();
        foreach ($order_details as $key => $order_detail) {
            $coupon = $order_detail->shipping_cou;
        }
        $Coupons = Coupon::where('code',$coupon)->first();
        if($Coupons){
            $coupon_number = $Coupons->number;
            $coupon_type =  $Coupons->type;
        }else {
            $coupon_type = 0 ;
            $coupon_number = 0 ;
        }
        $thue = 5;
        $phigiaohang = 0;
        $output ='';

        $output.='
        <style>
            body{
                font-family:DejaVu Sans;
            }
            h3,h2, h5{
                text-align: center;
            }
            .table{
                width:100%;
            }
            .table tbody tr{
                border-top: 1px solid #99999; 
            }
            .tien{
                text-align:right;
            }
            .number{
                text-align:center;
            }
            td{
                padding:5px;
                font-size:13px;
            }
            th{
                font-size:15px;
            }
            .tonghoadon{
                text-align:right;
            }
            .box-top{
                width:100%;
                font-size:12px;
                display: flex;
            }
            .top-noti{
                width:50%;
            }
            .top-time{
                width:50%;
                float:right;
                text-align: right!important;
            }
            .hello{
               font-size:14px; 
            }
            .text-left{
                text-align:left;
            }
            .text-right{
                text-align:right;
            }
            .text-center{
                text-align:center;
            }
            table thead tr .title{
                font-size:13px;
            }
        </style>
        <h3>Công ty TNHH 1 thành viên NOITHAT.VN</h3>
        <h2>HÓA ĐƠN BÁN HÀNG</h2>
        
        <div class="hello">
                 Xin chào <strong>'.$order->shipping->name.'</strong>,
                <br /> Biên lai cho khoản thanh toán của bạn được gửi từ NOITHAT.VN.
        </div>
        <hr >
        <div class="box-top">
             <div class="top-noti">
                    <div class="text-muted">Mã HD</div>
                    <strong style="text-transform: uppercase;">'.$order->order_code.'</strong>
            </div>
            <div class="top-time">
                    <div class="text-muted">Ngày đặt hàng</div>
                    <strong>'.$order->created_at.'</strong>
            </div>
        </div>
        <div class="box-top">
             <div class="top-noti">
                    <div class="text-muted">Người mua: '.$order->customer->name.'</div>
                    <div class="text-muted">SĐT: '.$order->customer->phone.'</div>
            </div>
            <div class="top-time">
                    <div class="text-muted">Người nhận: '.$order->customer->name.'</div>
                    <div class="text-muted">SĐT: '.$order->shipping->phone.'</div>
                    <div class="text-muted">Địa chỉ: '.$order->shipping->address.'</div>
            </div>
        </div>
            <br>
            <p>Thông tin đơn hàng</p>';
            
            $output.='</tbody>

            </table>
            

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th class="text-left title">Tên SP</th>
                        <th class="text-center title">Giá</th>
                        <th class="text-center title">Giá KM</th>
                        <th class="text-center title">SL</th>
                        <th class="text-right title">Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    ';
                    $Subtotal = 0;
                    foreach($order_details as $key => $order_detail) {
                    $output.='<tr>
                        <td class="text-left">'.$order_detail->product->tenvi.'</td>';
                    if($order_detail->product->price_pro==0) {    
                        $output.='<td class="text-center">
                        '.
                        number_format($order_detail->product->price,0,',','.');
                    }
                    else{
                        $output.='<td class="text-center " style="text-decoration:line-through;">
                        '.
                        number_format($order_detail->product->price,0,',','.');
                    }
                    $output.=
                    '</td>
                        <td class="text-center">'.number_format($order_detail->product->price_pro,0,',','.').'</td>
                        <td class="text-center">'.$order_detail->product_qty.'</td>
                        <td class="text-right">';
                        $total = 0;
                    if($order_detail->product->price_pro==0){
                        $total = $order_detail->product->price*$order_detail->product_qty;
                    }
                    else{
                        $total = $order_detail->product->price_pro*$order_detail->product_qty;
                    }
                    $Subtotal += $total;
                    $output.= ''.number_format($total,0,',','.').'</td>

                    </tr>
                    ';}
                    $tax = 0;
                    $giam = 0;
                    $tonghoadon = 0;
                    $tax = ($Subtotal/100)*5;
                    if($Coupons){
                        if($Coupons->type == 'phantram'){
                            $giam = ($Subtotal/100)*$Coupons->number;
                        }
                        else{
                            number_format($Coupons->number,0,',','.');
                            $giam = $Coupons->number;
                        }
                        $tonghoadon = $Subtotal+$tax- $giam;
                    }
                    else{
                        $tonghoadon = $Subtotal+$tax;
                    }
                    $output.='
                    <tr>
                        <th>&nbsp;</th>
                        <th >&nbsp;</th>
                        <th class="text-right" colspan="2">Tổng </th>
                        <th class="text-right">'.number_format($Subtotal,0,',','.').'</th>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <th >&nbsp;</th>
                        <th class="text-right" colspan="2">Phí ship</th>
                        <th class="text-right">0</th>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <th >&nbsp;</th>
                        <th class="text-right" colspan="2">Thuế 5%</th>
                        <th class="text-right">+ '.number_format($tax,0,',','.').'</th>
                    </tr>
                    ';
                    if($Coupons){
                        $output.='<tr>
                            <th>&nbsp;</th>
                            <th >&nbsp;</th>
                            <th class="text-right" colspan="2">Mã giảm giá '.$Coupons->code.'</th>
                            <th class="text-right">- '.number_format($giam,0,',','.').'</th>
                        </tr>';
                    };
                    $output.='<tr>
                        <th>&nbsp;</th>
                        <th >&nbsp;</th>
                        <th class="text-right" colspan="2">Tổng hóa đơn(VNĐ) </th>
                        <th class="text-right">'.number_format($tonghoadon,0,',','.').'</th>
                    </tr>
                </tbody>
            </table>
            <br>
            <p class="number">Xác nhận đơn hàng</p>
            <table>
                <thead >
                        <tr>
                            <th style="width:200px;">Người nhận</th>
                            <th style="width:800px;">Người bán hàng</th>
                        </tr>
                </thead>
            </table>';

        return  $output;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::Time($request)->Status($request)->OrderCode($request)->orderby('id','DESC')->paginate();
        $orders->appends(['order_code' => $request->order_code]);
        $orders->appends(['status' => $request->status]);
        $orders->appends(['time_start' => $request->time_start]);
        $orders->appends(['time_end' => $request->time_end]);
        return view('admin.pages.order.order_table')->with(compact('orders'));
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
        //
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
        $order =  Order::with('customer')->with('shipping')->where('id',$id)->first();
        $order_details = OrderDetail::with('product')->where('order_code',$order->order_code)->get();
        foreach ($order_details as $key => $order_detail) {
            $coupon = $order_detail->shipping_cou;
        }
        $Coupons = Coupon::where('code',$coupon)->first();
        $thue = 5;
        $phigiaohang = 0;
        return view('admin.pages.order.order_detail')->with(compact('order_details','order','Coupons','thue','phigiaohang'));
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
        $order = Order::find($id);
        $order->status = $request->status;
        if($order->save()){
            return 1;
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
        $del = Order::where('id',$id)->first();
        if($del->status == 0){
            $del->delete();
            return 1;
        }
        else{
            return 0;
        }
    }
}
