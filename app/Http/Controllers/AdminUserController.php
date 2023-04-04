<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;

class AdminUserController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function($request, $next){
           session(['module_active'=>'user']);
           return $next($request);
        });
    }
    function list(Request $request)
    {
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Vô hiệu hóa',
        ];

        if ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn',
            ];
            $users = User::onlyTrashed()->paginate(10);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $users = User::where('name', 'LIKE', "%{$keyword}%")->paginate(10);
            $roles=Role::all();
            // $roles_ass = $users->roles;
            // dd($roles_ass);
        }

        $count_user_active = User::count();
        $count_user_trash = User::onlyTrashed()->count();

        $count = [$count_user_active, $count_user_trash];

        return view('admin.user.list', compact('users', 'count', 'list_act', 'status'))->with('i',(request()->input('page',1)-1)*10);
    }
    function add()
    {
        $roles=Role::all();
        return view('admin.user.add', compact('roles'));
    }
    function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
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
                'password' => 'Mật khẩu',
                // 'password_confirm'=> 'Xác nhận mật khẩu'
            ]
        );
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        if(is_array($request->role)){
            foreach($request->role as $role_id){
              UserRole::create([
               'user_id'=>$user->id,
               'role_id'=>$role_id
              ]);
            }
         }
        Toastr::success('Thêm mới thành công', 'Thông báo');
        return redirect('admin/user/list');
    }
    function delete(Request $request, $id)
    {
        if (Auth::id() != $id) {
            $user = User::find($id);
            $user->delete();
            Toastr::success('Đã vô hiệu hóa thành viên thành công', 'Thông báo');
            return redirect('admin/user/list');
        } else {
            Toastr::error('Bạn không thể xóa mình ra khỏi hệ thống', 'Thông báo');
            return redirect('admin/user/list');
        }
    }
    function action(Request $request)
    {
        $list_check = $request->input('list_check');

        if ($list_check) {
            foreach ($list_check as $k => $id) {
                if (Auth::id() == $id) {
                    unset($list_check[$k]);
                }
            }
            if (!empty($list_check)) {
                $act = $request->input('act');
                if ($act == 'delete') {
                    User::destroy($list_check);
                    Toastr::success('Đã vô hiệu hóa thành viên thành công', 'Thông báo');
                    return redirect('admin/user/list')->with('status', 'Bạn đã xóa thành công');
                }
                if ($act == 'restore') {
                    User::withTrashed()->whereIn('id', $list_check)->restore();
                    Toastr::success('Đã khôi phục thành viên thành công', 'Thông báo');
                    return redirect('admin/user/list')->with('status', 'Bạn đã khôi phục thành công thành công');
                }
                if ($act == 'forceDelete') {
                    User::withTrashed()->whereIn('id', $list_check)->forceDelete();
                    Toastr::success('Bạn đã xóa vĩnh viễn user thành công', 'Thông báo');
                    return redirect('admin/user/list')->with('status', 'Bạn đã xóa vĩnh viễn user');
                }
            }
            Toastr::error('Bạn không thể thao tác trên tài khoản của bạn', 'Thông báo');
            return redirect('admin/user/list')->with('status', 'Bạn không thể thao tác trên tài khoản của bạn');
        } else {
            Toastr::error('Bạn cần chọn phần tử để thực hiện', 'Thông báo');
            return redirect('admin/user/list')->with('status', 'Bạn cần chọn phần tử để thực hiện');
        }
    }
    function edit($id)
    {
        $user = User::find($id);
        $roles=Role::all();
        $roles_ass = $user->roles->pluck('name','id')->toArray();
        // $role = $user->roles;
        // dd($roles_ass);
        return view('admin.user.edit', compact('user','roles','roles_ass'));
    }
    function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
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
                // 'email' => 'Email',
                'password' => 'Mật khẩu',
                // 'password_confirm'=> 'Xác nhận mật khẩu'
            ]
        );
        // $users = $request->all();
        // dd($users);
        $user = User::find($id);
        User::where('id', $id)->update([
            'name' => $request->input('name'),
            'password' => $request->input('password') ? Hash::make($request->input('password')): $user->password,
        ]);
        if(is_array($request->role)){
            UserRole::where('user_id',$id)->delete();
           foreach($request->role as $role_id){
             UserRole::create([
              'user_id'=>$user->id,
              'role_id'=>$role_id
             ]);
           }
        }
        Toastr::success('Bạn đã cập nhật user thành công', 'Thông báo');
        return redirect('admin/user/list')->with('status', 'Đã thêm cập nhật thành công');
    }
    function forceDelete($id)
    {
        $user = User::withTrashed()->find($id);
        $user->forceDelete();
        Toastr::success('Bạn đã xóa user ra khỏi hệ thống thành công', 'Thông báo');
        return redirect('admin/user/list');
    }
    function restore($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        Toastr::success('Đã khôi phục thành viên thành công', 'Thông báo');
        return redirect('admin/user/list')->with('status', 'Bạn đã khôi phục thành công thành công');
    }
    function role($id){
        $user = User::find($id);
        $roles=Role::all();
        $roles_ass = $user->roles->pluck('name','id')->toArray();
        // $role = $user->roles;
        // dd($roles_ass);
        return view('admin.user.role', compact('roles','roles_ass'));
    }
}
