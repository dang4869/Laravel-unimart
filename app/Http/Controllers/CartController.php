<?php

namespace App\Http\Controllers;

use App\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    //
    function show()
    {
        return view('frontend.cart');
    }
    function add(Request $request, $id)
    {
        $product = Product::find($id);
        $qty = $request->qty_num;
        $color = $request->color;

            Cart::add([
                'id' => $product->id,
                'name' => $product->product_name,
                'qty' => $qty,
                'price' => $product->price,
                'options' => [
                    'thumbnail' => $product->thumbnail,
                    'color' => $color
                ]
            ]);
            return  redirect('gio-hang');
    }
    function remove($rowId)
    {
        Cart::remove($rowId);
        return  redirect('gio-hang');
    }
    function destroy()
    {
        Cart::destroy();
        return  redirect('gio-hang');
    }
    function update(Request $request)
    {
        $rowId = $request->rowId;
        $price = $request->price;
        $qty = $request->qty;
        $total = $price * $qty;
        Cart::update($rowId, $qty);
        $count = Cart::count();
        $sub_total = Cart::total();
        $result = array(
            'rowId' => $rowId,
            'qty' => $qty,
            'price' => $price,
            'count' => $count,
            'total' => number_format($total, 0, ',', '.') . 'đ',
            'sub_total' => number_format($sub_total, 0, ',', '.'),
        );
        echo json_encode($result);
    }
}
