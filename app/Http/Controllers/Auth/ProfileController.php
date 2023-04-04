<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    function show(){
        return view('auth.profile');
    }
    function update(Request $request){
        $user = auth()->user();
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                // 'password' => ['required', 'string', 'min:8', 'confirmed'],
                // 'password_confirm'=>'required|string|min:8|confirmed'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'confirmed' => 'Xác nhận mật khẩu không thành công'
            ],
            [
                'name' => 'Tên người dùng',
                'email' => 'Email',
                // 'password' => 'Mật khẩu',
                // 'password_confirm'=> 'Xác nhận mật khẩu'
            ]
        );
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
        Toastr::success('Bạn đã cập nhật thông tin thành công', 'Thông báo');
        return redirect('profile')->with('status', 'Đã thêm cập nhật thành công');
    }
}
