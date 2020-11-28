<?php

namespace App\Http\Controllers\admin;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function view()
    {
        $orders = Order::orderBy('created_at','desc')->get();
        foreach ($orders as $order) {
            if ($order->status == 1) {
                if ($order->delivered == 0) {
                    $order->status_text = "Pending";
                } elseif ($order->delivered == 1) {
                    $order->status_text = "Delivered";
                }
            } else {
                $order->status_text = "Cancelled";
            }
        }
        return view('admin.order.orders', compact('orders'));
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        $order->status = 0;
        $order->save();
        foreach ($order->order_details as $orderDetail) {
            $product = Product::find($orderDetail->product_id);
            $product->stock_quantity = $product->stock_quantity + $orderDetail->quantity;
            $product->save();
        }
        return redirect()->back();
    }

    public function change_status(Request $request, $id){
//        dd($request);
        $order=Order::findOrFail($id);
        $order->paid = $request->paid;
        $order->delivered = $request->delivered;
        $order->save();
        return redirect()->back();
    }


    public function sort_year(Request $request){
        $orders = Order::where('created_at','==',$request->year)->get();
        foreach ($orders as $order) {
            if ($order->status == 1) {
                if ($order->delivered == 0) {
                    $order->status_text = "Pending";
                } elseif ($order->delivered == 1) {
                    $order->status_text = "Delivered";
                }
            } else {
                $order->status_text = "Cancelled";
            }
        }
        return response()->json(['redirect' =>'/admin/orders/view',compact('orders')]);
    }
    
    public function delivered(){
        $orders = Order::where('delivered','1')->where('status',1)->orderBy('created_at','desc')->get();
        return view('admin.order.order_delivered',compact('orders'));
    }
    public function pending(){
        $orders = Order::where('delivered','0')->where('status',1)->orderBy('created_at','desc')->get();
        return view('admin.order.order_pending',compact('orders'));
    }
    public function cancelled(){
        $orders = Order::where('status','0')->where('status',0)->orderBy('created_at','desc')->get();
        return view('admin.order.order_cancel',compact('orders'));
    }
}
