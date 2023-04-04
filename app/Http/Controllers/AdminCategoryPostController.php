<?php

namespace App\Http\Controllers;

use App\CategoryPost;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AdminCategoryPostController extends Controller
{
    //
    function show()
    {
        $category_posts = CategoryPost::orderby('id','desc')->paginate(10);
        return view('admin.categorypost.show', compact('category_posts'))->with('i',(request()->input('page',1)-1)*10);
    }
    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:6|max:200'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên danh mục',
            ]
        );
        CategoryPost::create([
            'category_post' => $request->input('name'),
        ]);
        Toastr::success('Thêm mới danh mục thành công', 'Thông báo');
        return redirect()->back();
    }
    function delete($id){
         $category_post = CategoryPost::find($id);
         $category_post->delete();
         Toastr::success('Đã xóa danh mục thành công', 'Thông báo');
         return redirect()->back();
    }
    function edit($id){
        $category_post = CategoryPost::find($id);
        return view('admin.categorypost.edit', compact('category_post'));
    }
    function update(Request $request, $id){
        $request->validate(
            [
                'name' => 'required|min:6|max:200'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên danh mục',
            ]
        );
        CategoryPost::where('id', $id)->update([
            'category_post' => $request->input('name'),
        ]);
        Toastr::success('Chỉnh sửa danh mục thành công', 'Thông báo');
        return redirect('admin/post/cat/add');
    }
}
