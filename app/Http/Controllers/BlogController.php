<?php

namespace App\Http\Controllers;

use App\Post;
use App\Product;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    function show(){
        $posts = Post::orderby('id','DESC')->paginate(10);
        $product_new = Product::where('product_status',1)->orderby('created_at', 'DESC')->limit(8)->get();
        return view('frontend.showblog',compact('product_new','posts'));
    }
    function blogdetail($slug){
        $product_new = Product::where('product_status',1)->orderby('created_at', 'DESC')->limit(8)->get();
        $detail_blog = Post::where('slug',$slug)->first();
        return view('frontend.blogdetail',compact('product_new','detail_blog'));
    }
}
