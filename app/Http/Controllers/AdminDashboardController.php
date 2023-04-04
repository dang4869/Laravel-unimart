<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function($request, $next){
           session(['module_active'=>'dashboard']);
           return $next($request);
        });
    }
    function show(){
        $orders = Order::orderby('id','DESC')->paginate(10);
        $order_success = Order::where('order_status',2)->count();
        $order_loading = Order::where('order_status',0)->count();
        $order_cancel = Order::where('order_status',3)->count();
        $total = Order::where('order_status',2)->sum('price_total');
        // return $total;
        return view('admin.dashboard',compact('orders','order_success','order_loading','order_cancel','total'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

}
