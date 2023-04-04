<?php

namespace App\Http\Controllers;

use App\District;
use App\Mail\CheckOutMail;
use App\Order;
use App\Order_detail;
use App\Province;
use App\Wards;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckOutController extends Controller
{
    //
    function show()
    {
        $provinces = Province::all();
        return view('frontend.checkout', compact('provinces'));
    }
    function province()
    {
        $province_id = $_GET['province_id'];
        $distris = District::where('province_id', $province_id)->get();

        $data[0] = [
            'id' => null,
            'name' => 'Chọn một quận/huyện'
        ];

        foreach ($distris as $dist) {
            $data[] = $dist;
        }
        echo json_encode($data);
    }
    function wards()
    {
        $district_id = $_GET['district_id'];
        $wards = Wards::where('district_id', $district_id)->get();

        $data[0] = [
            'id' => null,
            'name' => 'Chọn một phường/xã'
        ];
        foreach ($wards as $row) {
            $data[] = $row;
        }
        echo json_encode($data);
    }
    // Thêm đơn hàng mới
    function store(Request $request)
    {
        if ($request->payment == 2) {
            $request->validate(
                [
                    'order_name' => 'required',
                    'address' => 'required',
                    'phone' => 'required',
                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute có độ dài ít nhất :min ký tự',
                    'max' => ':attribute có độ dài tối đa :max ký tự',
                ],
                [
                    'order_name' => 'Họ tên',
                    'address' => 'Địa chỉ',
                    'phone' => 'Số điện thoại'
                ]
            );
            $data = array();
            $data['order_code'] = 'UNIMART-' . rand(0, 9999);
            $data['order_name'] = $request->input('order_name');
            $data['email'] = $request->input('email');
            $data['province'] = $request->input('province');
            $data['district'] = $request->input('district');
            $data['wards'] = $request->input('wards');
            $data['address'] = $request->input('address');
            $data['phone'] = $request->input('phone');
            $data['notes'] = $request->input('notes');
            $data['order_status'] = 0;
            $data['payment'] = $request->input('payment');
            $data['created_at'] = Carbon::now();
            $data['price_total'] = Cart::total();
            $order_id = DB::table('orders')->insertGetId($data);

            foreach (Cart::content() as $content) {
                Order_detail::create([
                    'order_id' => $order_id,
                    'product_id' => $content->id,
                    'product_name' => $content->name,
                    'product_price' => $content->price,
                    'product_qty' => $content->qty,
                    'color' => $content->options->color,
                    'thumbnail' => $content->options->thumbnail,
                    'total' => $content->total
                ]);
            }
            $order_time = Order::max('created_at');
            $order = Order::where('created_at', $order_time)->first();
            $order_detail = Order_detail::where('order_id', $order->id)->get();
            Mail::to($request->input('email'))->send(new CheckOutMail);

            return view('frontend.vnpay.index', compact('order', 'order_detail'));
        } else {
            $request->validate(
                [
                    'order_name' => 'required',
                    'address' => 'required',
                    'phone' => 'required',
                    'province' => 'required',
                    'district' => 'required',
                    'wards' => 'required',
                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute có độ dài ít nhất :min ký tự',
                    'max' => ':attribute có độ dài tối đa :max ký tự',
                ],
                [
                    'order_name' => 'Họ tên',
                    'address' => 'Địa chỉ',
                    'phone' => 'Số điện thoại',
                    'province' => 'Tỉnh, Thành Phố',
                    'district' => 'Quận, Huyện',
                    'wards' => 'Phường, Xã',
                ]
            );
            $data = array();
            $data['order_code'] = 'UNIMART-' . rand(0, 9999);
            $data['order_name'] = $request->input('order_name');
            $data['email'] = $request->input('email');
            $data['province'] = $request->input('province');
            $data['district'] = $request->input('district');
            $data['wards'] = $request->input('wards');
            $data['address'] = $request->input('address');
            $data['phone'] = $request->input('phone');
            $data['notes'] = $request->input('notes');
            $data['order_status'] = 0;
            $data['payment'] = $request->input('payment');
            $data['created_at'] = Carbon::now();
            $data['price_total'] = Cart::total();
            $order_id = DB::table('orders')->insertGetId($data);

            foreach (Cart::content() as $content) {
                Order_detail::create([
                    'order_id' => $order_id,
                    'product_id' => $content->id,
                    'product_name' => $content->name,
                    'product_price' => $content->price,
                    'product_qty' => $content->qty,
                    'color' => $content->options->color,
                    'thumbnail' => $content->options->thumbnail,
                    'total' => $content->total
                ]);
            }
        }

        Mail::to($request->input('email'))->send(new CheckOutMail);
        // $order = Order::find($order_id);
        // Cart::destroy();
        // return view('frontend.thankyou');
        return redirect('thong-tin-don-hang');
    }
    function single()
    {
        // $order_id = Order::max('id');
        // $order = Order::find($order_id);
        // $order_detail = Order_detail::where('order_id',$order_id)->get();
        $order_time = Order::max('created_at');
        $order = Order::where('created_at', $order_time)->first();
        $order_detail = Order_detail::where('order_id', $order->id)->get();
        Cart::destroy();
        return view('frontend.thankyou', compact('order', 'order_detail'));
    }
    function vnpay(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://localhost/unimart/thong-tin-don-hang";
        $vnp_TmnCode = "ZFJPMI1N"; //Mã website tại VNPAY
        $vnp_HashSecret = "JDKQEFWNFJVWMLICWUMROZFTOXDATAUD"; //Chuỗi bí mật

        $vnp_TxnRef = 'UNIMART-' . rand(0, 9999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán';
        $vnp_OrderType = 'billpaymen';
        $vnp_Amount = Cart::total() * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = $request->input('bank_code');
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
}
