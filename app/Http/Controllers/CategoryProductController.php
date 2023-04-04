<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryProduct;
use App\Product;

class CategoryProductController extends Controller
{
    //
    function show(Request $request,$slug){

        $category = CategoryProduct::where('slug',$slug)->first();
        $subcategory = CategoryProduct::where('category_parent',$category->id)->get();
        $sub_array= array();
        foreach ($subcategory as $sub){
            $sub_array[]= $sub->id;
        }
        $product = Product::where('category_product_id',$category->id)->paginate(12);
        $product_parent = Product::whereIn('category_product_id',$sub_array)->orderby('id','DESC')->paginate(12);
        if(isset( $_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by == 'giam_dan'){
                $product = Product::where('category_product_id',$category->id)->orderby('price','DESC')->paginate(12);
                $product_parent = Product::whereIn('category_product_id',$sub_array)->orderby('price','DESC')->paginate(12);
            }
            if($sort_by == 'tang_dan'){
                $product = Product::where('category_product_id',$category->id)->orderby('price','ASC')->paginate(12);
                $product_parent = Product::whereIn('category_product_id',$sub_array)->orderby('price','ASC')->paginate(12);
            }
            if($sort_by == 'kytu_az'){
                $product =  Product::where('category_product_id',$category->id)->orderby('product_name','ASC')->paginate(12);
                $product_parent = Product::whereIn('category_product_id',$sub_array)->orderby('product_name','ASC')->paginate(12);
            }
            if($sort_by == 'kytu_za'){
                $product =  Product::where('category_product_id',$category->id)->orderby('product_name','DESC')->paginate(12);
                $product_parent = Product::whereIn('category_product_id',$sub_array)->orderby('product_name','DESC')->paginate(12);
            }
        }
        if(isset( $_GET['sort_by_price'])){
            $sort_by = $_GET['sort_by_price'];
            if($sort_by == 'duoi_5t'){
                $product = Product::where('category_product_id',$category->id)->whereBetween('price', [0, 500000])->paginate(12);
                $product_parent = Product::whereIn('category_product_id',$sub_array)->whereBetween('price', [0, 500000])->paginate(12);
            }
            if($sort_by == 'tu_5t_1tr'){
                $product = Product::where('category_product_id',$category->id)->whereBetween('price', [500000, 1000000])->paginate(12);
                $product_parent = Product::whereIn('category_product_id',$sub_array)->whereBetween('price', [500000, 1000000])->paginate(12);
            }
            if($sort_by == 'tu_1tr_5tr'){
                $product =  Product::where('category_product_id',$category->id)->whereBetween('price', [1000000, 5000000])->paginate(12);
                $product_parent = Product::whereIn('category_product_id',$sub_array)->whereBetween('price', [1000000, 5000000])->paginate(12);
            }
            if($sort_by == 'tu_5tr_10tr'){
                $product =  Product::where('category_product_id',$category->id)->whereBetween('price', [5000000, 10000000])->paginate(12);
                $product_parent = Product::whereIn('category_product_id',$sub_array)->whereBetween('price', [5000000, 10000000])->paginate(12);
            }
            if($sort_by == 'tren_10tr'){
                $product =  Product::where('category_product_id',$category->id)->whereNotBetween('price', [0, 10000000])->paginate(12);
                $product_parent = Product::whereIn('category_product_id',$sub_array)->whereNotBetween('price', [0, 10000000])->paginate(12);
            }
        }
        $categorys = CategoryProduct::where('category_parent',0)->get();
        return view('frontend.category_product',compact('categorys','product','category','product_parent'));
    }

}
