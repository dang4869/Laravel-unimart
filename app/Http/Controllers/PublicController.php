<?php

namespace App\Http\Controllers;

use App\CategoryProduct;
use App\Page;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    //
    function show(Request $request){
        $categorys = CategoryProduct::where('category_parent',0)->get();
        $subcategory_phone = CategoryProduct::where('category_parent',28)->get();
        $sub_array_phone= array();
        foreach ($subcategory_phone as $sub_phone){
            $sub_array_phone[]= $sub_phone->id;
        }
        $product_phone = Product::whereIn('category_product_id',$sub_array_phone)->where('product_status',1)->orderby('id','DESC')->limit(8)->get();
        $subcategory_laptop = CategoryProduct::where('category_parent',31)->get();
        $sub_array_laptop= array();
        foreach($subcategory_laptop as $sub_lap){
          $sub_array_laptop[]=$sub_lap->id;
        }
        $product_laptop = Product::whereIn('category_product_id',$sub_array_laptop)->where('product_status',1)->orderby('id','DESC')->limit(8)->get();
        $product_new = Product::where('product_status',1)->orderby('created_at', 'DESC')->limit(8)->get();
        $product_featured = Product::where('properties',1)->orderby('updated_at', 'DESC')->limit(8)->get();
        $slider = Slider::orderby('id','DESC')->limit(5)->get();
        $pages = Page::orderby('id','DESC')->get();
        //  echo "<pre>";
        //  print_r($product_phone);
        //  echo "</pre>";
        return view('frontend.home',compact('categorys','product_phone','product_laptop','product_new','product_featured','slider','pages'));
    }

}
