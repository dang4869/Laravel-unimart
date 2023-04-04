<?php

namespace App\Http\Controllers;

use App\Role;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminRoleController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function($request, $next){
           session(['module_active'=>'role']);
           return $next($request);
        });
    }
    function list(){
        $roles = Role::orderby('id','DESC')->paginate(10);
        return view('admin.role.list',compact('roles'))->with('i',(request()->input('page',1)-1)*10);
    }
    function add(){
        $routes = [];
        $all = Route::getRoutes();
        foreach($all as $r){
            $name = $r->getName();
            $pos = strpos($name,'admin');
            if($pos !== false){
                array_push($routes, $r->getName()) ;
            }
        }
        // dd($routes);
      return view('admin.role.add',compact('routes'));
    }
    function store(Request $request){
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                // 'role_group' => ['required', 'string', 'max:255'],
                // 'password_confirm'=>'required|string|min:8|confirmed'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'confirmed' => 'Xác nhận mật khẩu không thành công'
            ],
            [
                'name' => 'Tên quyên',
                'role_group' => 'Nhóm quyền',
            ]
        );
        // array_push($request->route,'admin.show');
        $routes = json_encode($request->role_group);
        // dd($routes);
        Role::create([
            'name' => $request->input('name'),
            'role_group' => $routes,
        ]);
        Toastr::success('Thêm mới quyền thành công', 'Thông báo');
        return redirect('admin/role/list');
    }
    function delete($id){
        Role::where('id',$id)->delete();
        Toastr::success('Xóa quyền thành công', 'Thông báo');
        return redirect('admin/role/list');
    }
    function edit($id){
        $role = Role::find($id);
        $role_group = json_decode($role->role_group);
        // dd($role_group);
        $routes = [];
        $all = Route::getRoutes();
        foreach($all as $r){
            $name = $r->getName();
            $pos = strpos($name,'admin');
            if($pos !== false){
                array_push($routes, $r->getName()) ;
            }
        }
        return view('admin.role.edit',compact('role','routes','role_group'));
    }
    function update(Request $request, $id){
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                // 'role_group' => ['required', 'string', 'max:255'],
                // 'password_confirm'=>'required|string|min:8|confirmed'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'confirmed' => 'Xác nhận mật khẩu không thành công'
            ],
            [
                'name' => 'Tên quyên',
                'role_group' => 'Nhóm quyền',
            ]
        );
        // array_push($request->route,'admin.show');
        $routes = json_encode($request->role_group);
        // dd($routes);
        Role::where('id',$id)->update([
            'name' => $request->input('name'),
            'role_group' => $routes,
        ]);
        Toastr::success('Cập nhật quyền thành công', 'Thông báo');
        return redirect('admin/role/list');
    }
}
