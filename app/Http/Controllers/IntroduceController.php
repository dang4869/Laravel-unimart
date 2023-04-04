<?php

namespace App\Http\Controllers;

use App\Page;
use App\Product;
use Illuminate\Http\Request;

class IntroduceController extends Controller
{
    //
    function show(){
        $product_new = Product::where('product_status',1)->orderby('created_at', 'DESC')->limit(8)->get();
        $intro = Page::where('slug','gioi-thieu')->first();
        return view('frontend.intro',compact('product_new','intro'));
    }
}
