<?php

namespace App\Http\Controllers;

use App\CategoryProduct;
use App\Product;
use App\ProductColor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProductController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'product']);
            return $next($request);
        });
    }
    function list(Request $request)
    {
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $products = Product::where('product_name', 'LIKE', "%{$keyword}%")->orderby('id','DESC')->paginate(10);
        $status = $request->input('status');
        if ($status == 'public') {
            $products = Product::where('product_status', 1)->orderby('id','DESC')->paginate(10);
        }
        if ($status == 'pending') {
            $products = Product::where('product_status', 0)->orderby('id','DESC')->paginate(10);
        }
        if ($status == 'featured') {
            $products = Product::where('properties', 1)->orderby('id','DESC')->paginate(10);
        }
        if ($status == 'selling') {
            $products = Product::where('properties', 2)->orderby('id','DESC')->paginate(10);
        }
        // Thống kê sản phẩm
        $count_public =  Product::where('product_status', 1)->count();
        $count_pending =  Product::where('product_status', 0)->count();
        $count_featured =  Product::where('properties', 1)->count();
        $count_selling =  Product::where('properties', 2)->count();
        $count = [$count_public, $count_pending, $count_featured,$count_selling ];
        return view('admin.product.list', compact('products', 'count','status'))->with('i', (request()->input('page', 1) - 1) * 10);
    }
    function add()
    {
        $colors = ProductColor::all();
        $category = $this->getCategoryProduct();
        return view('admin.product.add', compact('category', 'colors'));
    }
    function getCategoryProduct()
    {
        $categoryproducts = CategoryProduct::all();
        $listCategory = [];
        CategoryProduct::recursive($categoryproducts, $parents = 0, $level = 1, $listCategory);
        return $listCategory;
    }
    function store(Request $request)
    {
        $request->validate(
            [
                'product_name' => 'required',
                'product_desc' => 'required',
                'category_product_id' => 'required',
                'product_detail' => 'required',
                'price' => 'required',
                'slug' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài ít nhất :max ký tự',
            ],
            [
                'product_name' => 'Tên sản phẩm',
                'product_desc' => 'Mô tả sản phẩm',
                'category_product_id' => 'Danh mục sản phẩm',
                'product_detail' => 'Chi tiết sản phẩm',
                'price' => 'Giá sản phẩm',
                'slug' => 'Link thân thiện'
            ]
        );

        $input = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file;
            //    Lấy tên file
            $filename = $file->getClientOriginalName();
            // Lấy đuôi file
            echo $file->getClientOriginalExtension();
            // Lấy kích thước file
            echo $file->getSize();
            // Upload file lên server
            $path = $file->move('public/uploads/product', $file->getClientOriginalName());
            $thumbnail = 'public/uploads/product/' . $filename;

            $input['thumbnail'] = $thumbnail;
        }
        $input['user_id'] = Auth::id();
        // dd($input);
        if ($input['category_product_id'] == 0) {
            Toastr::error('Bạn thêm bài viết thất bại vì chưa chọn danh mục bài viết', 'Thông báo');
            return redirect()->back();
        }
        Product::create($input);
        // return $request->input();
        Toastr::success('Thêm mới sản phẩm thành công', 'Thông báo');
        return redirect('admin/product/list');
    }
    function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        Toastr::success('Xóa sản phẩm thành công', 'Thông báo');
        return redirect('admin/product/list');
    }
    function edit($id)
    {
        $product = Product::find($id);
        $colors = ProductColor::all();
        $category = $this->getCategoryProduct();
        return view('admin.product.edit', compact('product', 'colors', 'category'));
    }
    function update(Request $request, $id)
    {
        $request->validate(
            [
                'product_name' => 'required',
                'product_desc' => 'required',
                'category_product_id' => 'required',
                'product_detail' => 'required',
                'price' => 'required',
                // 'slug' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài ít nhất :max ký tự',
            ],
            [
                'product_name' => 'Tên sản phẩm',
                'product_desc' => 'Mô tả sản phẩm',
                'category_product_id' => 'Danh mục sản phẩm',
                'product_amout' => 'Số lượng sản phẩm',
                'product_status' => 'Trạng thái sản phẩm',
                'product_detail' => 'Chi tiết sản phẩm',
                'product_color_id' => 'Màu sản phẩm',
                'price' => 'Giá sản phẩm',
            ]
        );
        $product = Product::find($id);
        // $input = $request->all();
        if ($request->hasFile('file')) {
            $product_image_old = $product->thumbnail;
            // $path = 'public/uploads/post/' . $post_image_old;
            unlink($product_image_old);
            $file = $request->file;
            //    Lấy tên file
            $filename = $file->getClientOriginalName();
            // Lấy đuôi file
            echo $file->getClientOriginalExtension();
            // Lấy kích thước file
            echo $file->getSize();
            // Upload file lên server
            $path = $file->move('public/uploads/product', $file->getClientOriginalName());
            $thumbnail = 'public/uploads/product/' . $filename;

            // $input['thumbnail'] = isset($thumbnail) ? $thumbnail: $post->thumbnail;
        }
        if (request()->input('category_product_id') == 0) {
            Toastr::error('Bạn cập nhật sản phẩm thất bại', 'Thông báo');
            return redirect()->back();
        }
        // $input['category_post_id']=3;
        Product::where('id', $id)->update([
            'product_name' => $request->product_name,
            'product_desc' => $request->product_desc,
            'thumbnail' => isset($thumbnail) ? $thumbnail : $product->thumbnail,
            'category_product_id' => $request->category_product_id,
            'product_detail' => $request->product_detail,
            'price' => $request->price,
            'product_status'=>$request->product_status,
            'properties'=>$request->properties
        ]);
        // return $request->input();
        Toastr::success('Cập nhật sản phẩm thành công', 'Thông báo');
        return redirect('admin/product/list');
    }
    function action(Request $request)
    {
        $list_check = $request->input('list_check');
        if ($list_check) {
            if (!empty($list_check)) {
                $act = $request->input('act');
                if ($act == 'delete') {
                    Product::destroy($list_check);
                    Toastr::success('Bạn đã xóa sản phẩm thành công', 'Thông báo');
                    return redirect('admin/product/list');
                }
                if($act == 'public'){
                    Product::whereIn('id',$list_check)->update([
                        'product_status' => 1
                    ]);
                    Toastr::success('Bạn đã cập nhật trạng thái sản phẩm thành công', 'Thông báo');
                    return redirect('admin/product/list');
                }
                if($act == 'pending'){
                    Product::whereIn('id',$list_check)->update([
                        'product_status' => 0
                    ]);
                    Toastr::success('Bạn đã cập nhật trạng thái sản phẩm thành công', 'Thông báo');
                    return redirect('admin/product/list');
                }
                if($act == 'featured' || $act == '0'){
                    Product::whereIn('id',$list_check)->update([
                        'properties' => 0
                    ]);
                    Toastr::success('Bạn đã cập nhật thuộc tính sản phẩm thành công', 'Thông báo');
                    return redirect('admin/product/list');
                }
            }
        } else {
            Toastr::error('Bạn cần chọn phần tử để thực hiện', 'Thông báo');
            return redirect()->back();
        }
    }
}
