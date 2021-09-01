<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;
class OrderController extends Controller
{
    public function store(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    	$feeship = 0;
    	$data = $request->all();
    	$Shipping = new Shipping();
    	$Shipping->name = $data['name'];
    	$Shipping->address = $data['address'];
    	$Shipping->phone = $data['phone'];
    	$Shipping->email = $data['email'];
    	$Shipping->notes = $data['note'];
    	$Shipping->method = $data['method'];
    	$Shipping->save();

    	$order_code = substr(md5(microtime()),rand(0,26),6);
    	$order = new Order();

    	$order->customer_id = Session::get('user_id');
    	$order->shipping_id = $Shipping->id;
    	$order->order_code = $order_code;
    	$order->feeship = $feeship;
    	$order->save();

    	if(Session::get('carts')){
    		foreach (Session::get('carts') as $key => $cart) {
    			$order_detail = new OrderDetail();
    			$order_detail->order_code = $order_code;
    			$order_detail->product_id =$cart['product_id'];
    			// $order_detail->product_name =$cart['product_name'];
    			// $order_detail->product_image = $cart['product_photo'];
    			// $order_detail->product_price = $cart['product_price'];
    			// $order_detail->product_price_pro = $cart['product_price_pro'];
    			$order_detail->product_qty = $cart['product_qty'];
    			$order_detail->shipping_cou = $data['shipping_cou'];
    			$order_detail->save();
    		}
    	}
    	Session::forget('carts');
    	Session::forget('coupon_session');
    	return 1;
    }
}
