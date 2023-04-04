<?php

namespace App\Http\Controllers;

use App\CategoryProduct;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AdminCategoryProductController extends Controller
{
    //

    function list(){
        $categoryproducts = CategoryProduct::where('category_parent',0)->orderBy('id','DESC')->get();
        // $category_product = CategoryProduct::all();
        $categoryproducts_all = CategoryProduct::paginate(10);
        $category = $this->getCategoryProduct();
        //  echo "<pre>";
        //  print_r($category);
        //  echo "</pre>";
        return view('admin.categoryproduct.list', compact('categoryproducts','categoryproducts_all','category'))->with('i',(request()->input('page',1)-1)*10);
    }
    function getCategoryProduct(){
        $categoryproducts = CategoryProduct::all();
        $listCategory = [];
        CategoryProduct::recursive($categoryproducts, $parents = 0, $level = 1, $listCategory);
        return $listCategory;
    }
    function store(Request $request){
        $request->validate(
            [
                'name' => 'required',
                'slug' => 'required',
                'category_parent' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên danh mục',
                'slug' => 'Tên link thân thiện',
                'category_parent' => 'Danh mục cha',
            ]
        );
        CategoryProduct::create([
            'category_name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'category_parent' => $request->input('category_parent'),
            'category_status'=>0
        ]);
        Toastr::success('Thêm mới danh mục thành công', 'Thông báo');
        return redirect()->back();
    }
    function delete($id){
        $categoryproduct = CategoryProduct::find($id);
        $count = CategoryProduct::where('category_parent',$id)->count();
        if($count>0){
            Toastr::error('Bạn cần xóa danh mục con của nó trước', 'Thông báo');
            return redirect()->back();
        }
        $categoryproduct->delete();
        Toastr::success('Xóa danh mục thành công', 'Thông báo');
        return redirect()->back();
    }
    function edit($id){
        $category = $this->getCategoryProduct();
        $categoryproduct = CategoryProduct::find($id);
        $categoryproducts = CategoryProduct::where('category_parent',0)->orderBy('id','DESC')->get();
        return view('admin.categoryproduct.edit',compact('categoryproduct','categoryproducts','category'));
    }
    function update(Request $request, $id){
        $request->validate(
            [
                'name' => 'required|min:6|max:200',
                'slug' => 'required|min:6|max:200',
                'category_parent' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên danh mục',
                'slug' => 'Tên link thân thiện',
                'category_parent' => 'Danh mục cha',
            ]
        );
        CategoryProduct::where('id',$id)->update([
            'category_name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'category_parent' => $request->input('category_parent'),
            'category_status'=>0
        ]);
        Toastr::success('Cập nhật danh mục thành công', 'Thông báo');
        return redirect('admin/product/cat/list');
    }
}
