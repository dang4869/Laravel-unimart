<?php

namespace App\Http\Controllers;

use App\Page;
use App\Product;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    function show(){
        $product_new = Product::where('product_status',1)->orderby('created_at', 'DESC')->limit(8)->get();
        $contact = Page::where('slug','lien-he')->first();
        return view('frontend.contact',compact('product_new','contact'));
    }
}
