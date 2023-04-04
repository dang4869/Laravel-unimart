<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryProduct;
use App\Gallery;
use App\Product;
use App\ProductColor;

class ProductController extends Controller
{
    //
    function detail($slug){
        $categorys = CategoryProduct::where('category_parent',0)->get();
        $detail_product = Product::where('slug',$slug)->first();
        $product_same = Product::where('category_product_id',$detail_product->category_product_id)->get();
        $img = Gallery::where('product_id',$detail_product->id)->get();
        $color_amout= ProductColor::where('product_id',$detail_product->id)->get();
        $min = ProductColor::where('product_id',$detail_product->id)->min('id');
        //  echo "<pre>";
        //  print_r($img);
        //  echo "</pre>";
        return view('frontend.detail_product',compact('categorys','detail_product','product_same','img','color_amout','min'));
    }
    function show(){
        $products = Product::orderby('id','DESC')->paginate(12);
        $categorys = CategoryProduct::where('category_parent',0)->get();
        if(isset( $_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by == 'giam_dan'){
                $products = Product::orderby('price','DESC')->paginate(12);
            }
            if($sort_by == 'tang_dan'){
                $products = Product::orderby('price','ASC')->paginate(12);
            }
            if($sort_by == 'kytu_az'){
                $products = Product::orderby('product_name','ASC')->paginate(12);
            }
            if($sort_by == 'kytu_za'){
                $products = Product::orderby('product_name','DESC')->paginate(12);
            }
        }
        if(isset( $_GET['sort_by_price'])){
            $sort_by = $_GET['sort_by_price'];
            if($sort_by == 'duoi_5t'){
                $products = Product::whereBetween('price', [0, 500000])->paginate(12);
            }
            if($sort_by == 'tu_5t_1tr'){
                $products = Product::whereBetween('price', [500000, 1000000])->paginate(12);
            }
            if($sort_by == 'tu_1tr_5tr'){
                $products =  Product::whereBetween('price', [1000000, 5000000])->paginate(12);
            }
            if($sort_by == 'tu_5tr_10tr'){
                $products =  Product::whereBetween('price', [5000000, 10000000])->paginate(12);
            }
            if($sort_by == 'tren_10tr'){
                $products =  Product::whereNotBetween('price', [0, 10000000])->paginate(12);
            }
        }
        return view('frontend.product',compact('products','categorys'));
    }
}
