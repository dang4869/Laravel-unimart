<?php

namespace App\Http\Controllers;

use App\Order;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function($request, $next){
           session(['module_active'=>'order']);
           return $next($request);
        });
    }
    function list(Request $request){
        $status = $request->input('status');
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $orders = Order::where('order_name', 'LIKE', "%{$keyword}%")->orderby('id','DESC')->paginate(10);
        if ($status == 'loading') {
            $orders = Order::where('order_status', 0)->orderby('id','DESC')->paginate(10);
        }
        if ($status == 'delivery') {
            $orders = Order::where('order_status', 1)->orderby('id','DESC')->paginate(10);
        }
        if ($status == 'success') {
            $orders = Order::where('order_status', 2)->orderby('id','DESC')->paginate(10);
        }
        if ($status == 'cancelled') {
            $orders = Order::where('order_status', 3)->orderby('id','DESC')->paginate(10);
        }
        $count_loading =  Order::where('order_status', 0)->count();
        $count_delivery =  Order::where('order_status', 1)->count();
        $count_success =  Order::where('order_status', 2)->count();
        $count_cancelled =  Order::where('order_status', 3)->count();
        $count = [ $count_loading , $count_delivery,$count_success,$count_cancelled];
        return view('admin.order.list', compact('orders','count','status'))->with('i', (request()->input('page', 1) - 1) * 10);
    }
    function delete($id){
        Order::where('id',$id)->delete();
        Toastr::success('Xóa đơn hàng thành công', 'Thông báo');
        return redirect()->back();
    }
    function action(Request $request){
        $list_check = $request->input('list_check');
        if ($list_check) {
            if (!empty($list_check)) {
                $act = $request->input('act');
                if ($act == 'delete') {
                    Order::destroy($list_check);
                    Toastr::success('Bạn đã xóa đơn hàng thành công', 'Thông báo');
                    return redirect('admin/order/list');
                }
                if($act == 'loading'){
                    Order::whereIn('id',$list_check)->update([
                        'order_status' => 0
                    ]);
                    Toastr::success('Bạn đã cập nhật trạng thái đơn hàng thành công', 'Thông báo');
                    return redirect('admin/order/list');
                }
                if($act == 'delivery'){
                    Order::whereIn('id',$list_check)->update([
                        'order_status' => 1
                    ]);
                    Toastr::success('Bạn đã cập nhật trạng thái đơn hàng thành công', 'Thông báo');
                    return redirect('admin/order/list');
                }
                if($act == 'success'){
                    Order::whereIn('id',$list_check)->update([
                        'order_status' => 2
                    ]);
                    Toastr::success('Bạn đã cập nhật trạng thái đơn hàng thành công', 'Thông báo');
                    return redirect('admin/order/list');
                }
                if($act == 'cancelled'){
                    Order::whereIn('id',$list_check)->update([
                        'order_status' => 3
                    ]);
                    Toastr::success('Bạn đã cập nhật trạng thái đơn hàng thành công', 'Thông báo');
                    return redirect('admin/order/list');
                }
            }
        } else {
            Toastr::error('Bạn cần chọn phần tử để thực hiện', 'Thông báo');
            return redirect()->back();
        }
    }
}
