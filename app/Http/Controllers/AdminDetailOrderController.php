<?php

namespace App\Http\Controllers;

use App\District;
use App\Order;
use App\Order_detail;
use App\Province;
use App\Wards;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AdminDetailOrderController extends Controller
{
    //
    function show($id){
        $order_detail = Order_detail::where('order_id',$id)->paginate(10);
        $order = Order::find($id);
        $list_status = [
            0 => 'Đang xử lý',
            1 => 'Đang vận chuyển',
            2 => 'Hoàn thành',
            3 => 'Đã hủy'
        ];
        $province = Province::where('province_id',$order->province)->first();
        $district = District::where('district_id',$order->district)->first();
        $wards = Wards::where('wards_id',$order->wards)->first();
      return view('admin.detailorder.show',compact('order_detail','order','list_status','province','district','wards'))->with('i', (request()->input('page', 1) - 1) * 10);
    }
    function update(Request $request, $id){
        Order::where('id',$id)->update([
            'order_status'=>$request->order_status
          ]);
          Toastr::success('Bạn đã cập nhật trạng thái đơn hàng thành công', 'Thông báo');
        return redirect('admin/order/list');
    }
}
