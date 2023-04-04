<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryProduct;
use App\Product;

class SearchController extends Controller
{
    //
    function search(Request $request)
    {
        // $products = Product::all();
        $categorys = CategoryProduct::where('category_parent', 0)->get();
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        } else {
            return redirect('trang-chu');
        }
        $products = Product::where('Product_name', 'LIKE', "%{$keyword}%")->paginate(12);
        return view('frontend.search', compact('categorys', 'products'));
    }
    function ajax(Request $request)
    {
        $data = $request->all();

        if ($data['query']) {
            $products = Product::where('Product_name', 'LIKE', '%' . $data['query'] . '%')->get();

            $output = '<ul>';
            foreach ($products as $val) {
                $output .= '
                <li class="search-ajax">
                     <a href="'.route('product.detail',$val->slug).'" style="flex-basis:15%;" >
                     <img src="'.url($val->thumbnail).'">
                     </a>
                    <a href="'.route('product.detail',$val->slug).'" style="flex-basis: 82%; padding-left:50px; color:cadetblue; font-size:14px;  margin-top: 25px;">
                        '.$val->product_name.'</a>
                     </li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
