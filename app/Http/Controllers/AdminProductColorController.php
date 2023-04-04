<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductColor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AdminProductColorController extends Controller
{
    //
    function show($id)
    {
        $colors = ProductColor::where('product_id',$id)->orderby('id','desc')->get();
        // $pro_id= ProductColor::find($id);
        // $color_id=$pro_id->product_id;
        //  $product_color = ProductColor::find($color_id)->product;
        // return $product_color;
        $color = ProductColor::where('product_id',$id)->orderby('id','desc')->count();
        $total = ProductColor::where('product_id',$id)->sum('amout');
        // return $total;
        $product = Product::find($id);
        // return $color;
        return view('admin.productcolor.show', compact('colors','id','color','total','product'))->with('i',(request()->input('page',1)-1)*10);
    }
    function store(Request $request,$id)
    {
        $request->validate(
            [
                'name' => 'required',
                'color_code' => 'required',
                'amout' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên màu',
                'color_code' => 'Mã màu',
                'amout' => 'Số lượng'
            ]
        );
        // dd($request->id);
        ProductColor::create([
            'name' => $request->input('name'),
            'color_code' => $request->input('color_code'),
            'amout' => $request->input('amout'),
            'product_id'=>$request->id
        ]);
        Toastr::success('Thêm mới màu thành công', 'Thông báo');
        return redirect()->back();
    }
    function delete($id){
        $color = ProductColor::find($id);
        $color->delete();
        Toastr::success('Xóa màu thành công', 'Thông báo');
        return redirect()->back();
    }
    function edit($id){
        $color = ProductColor::find($id);
        return view('admin.productcolor.edit',compact('color'));
    }
    function update(Request $request, $id){
        $request->validate(
            [
                'name' => 'required',
                'color_code' => 'required',
                'amout' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên màu',
                'color_code' => 'Mã màu',
                'color_code' => 'Mã màu',
            ]
        );
        $pro_id= ProductColor::find($id);
        $color_id=$pro_id->product_id;
        ProductColor::where('id',$id)->update([
            'name' => $request->input('name'),
            'color_code' => $request->input('color_code'),
            'amout' => $request->input('amout'),
        ]);
        Toastr::success('Chỉnh sửa màu thành công', 'Thông báo');
        return redirect('admin/product/color/show/'.$color_id);
    }
}
