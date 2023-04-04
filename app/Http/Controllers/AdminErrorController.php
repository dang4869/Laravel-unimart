<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminErrorController extends Controller
{
    //
    function show(){
        $code = request()->code;
        $errors = [
            'code'=>403,
            'title' => 'Unauthorzed',
            'message' => 'Bạn không có quyền'
        ];
        return view('admin.error', compact('errors'));
    }
}
