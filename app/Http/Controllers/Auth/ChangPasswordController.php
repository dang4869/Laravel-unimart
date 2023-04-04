<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangPasswordController extends Controller
{
    //
    function edit()
    {
        return view('auth.passwords.changpassword');
    }
    function update(Request $request)
    {
        $request->validate(
            [
                'old_password' => ['required', 'string', 'min:8', 'max:100'],
                'new_password' => ['required', 'string', 'min:8', 'max:100'],
                // 'confirm_password' => ['required', 'string', 'min:8', 'same:new_password'],
                // 'password_confirm'=>'required|string|min:8|confirmed'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'confirmed' => 'Xác nhận mật khẩu không thành công'
            ],
            [
                'old_password' => 'Mật khẩu cũ',
                'new_password' => 'Mật khẩu mới',
                'confrim_password' => 'Xác nhận mật khẩu',
                // 'password_confirm'=> 'Xác nhận mật khẩu'
            ]
        );
        $current_user = auth()->user();
        if (!Hash::check($request->old_password, $current_user->password)) {
            Toastr::error('Mật khẩu cũ không đúng', 'Thông báo');
            return redirect()->back();
        }
        $current_user->update([
            'password' => Hash::make($request->new_password)
        ]);
        Auth::logout();
        Toastr::success('Bạn đã đổi mật khẩu thành công', 'Thông báo');
        return redirect('login')->with('status','Bạn đã đổi mật khẩu thành công! Bạn đăng nhập để vào trang quản lí');
    }
}
