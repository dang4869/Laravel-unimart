<?php

namespace App\Http\Controllers;

use App\Page;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'page']);
            return $next($request);
        });
    }
    function list(Request $request)
    {
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $pages = Page::where('name_page', 'LIKE', "%{$keyword}%")->paginate(10);
        return view('admin.page.list', compact('pages'))->with('i', (request()->input('page', 1) - 1) * 10);
    }
    function add()
    {
        return view('admin.page.add');
    }
    function store(Request $request)
    {
        $request->validate(
            [
                'name_page' => 'required|max:100',
                'content' => 'required',
                'slug' => 'required|max:100',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài ít nhất :max ký tự',
            ],
            [
                'name_page' => 'Tiêu đề trang',
                'content' => 'Nội dung trang',
                'slug' => 'Link thân thiện',
            ]
        );
        Page::create([
            'name_page' => $request->input('name_page'),
            'slug' => $request->input('slug'),
            'content' => $request->input('content')
        ]);
        Toastr::success('Thêm mới thành công', 'Thông báo');
        return redirect('admin/page/list');
    }
    function delete($id)
    {
        $page = Page::find($id);
        $page->delete();
        Toastr::success('Bạn đã xóa trang thành công', 'Thông báo');
        return redirect('admin/page/list');
    }
    function action(Request $request){
        $list_check = $request->input('list_check');
        if($list_check){
            if(!empty($list_check)){
                $act = $request->input('act');
                if($act == 'delete'){
                    Page::destroy($list_check);
                    Toastr::success('Bạn đã xóa trang thành công', 'Thông báo');
                    return redirect('admin/page/list');
                }
            }
        }else{
            Toastr::error('Bạn cần chọn phần tử để thực hiện', 'Thông báo');
            return redirect()->back();
        }
    }
    function edit($id){
      $page = Page::find($id);
      return view('admin.page.edit', compact('page'));
    }
    function update(Request $request, $id){
        $request->validate(
            [
                'name_page' => 'required|max:100|min:5',
                'content' => 'required',
                'slug' => 'required|max:100|min:5',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài ít nhất :max ký tự',
            ],
            [
                'name_page' => 'Tiêu đề trang',
                'content' => 'Nội dung trang',
                'slug' => 'Link thân thiện',
            ]
        );
        Page::where('id',$id)->update([
            'name_page' => $request->input('name_page'),
            'slug' => $request->input('slug'),
            'content' => $request->input('content')
        ]);
        Toastr::success('Cập nhật thành công', 'Thông báo');
        return redirect('admin/page/list');
    }
}
