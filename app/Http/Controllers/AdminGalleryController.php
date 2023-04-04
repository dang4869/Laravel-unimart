<?php

namespace App\Http\Controllers;

use App\Gallery;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AdminGalleryController extends Controller
{
    //
    function add($id){
        $pro_id=$id;
        // $gallery = Gallery::where('product_id', $pro_id)->get();
        // return $gallery;
        return view('admin.gallery.add',compact('pro_id'));
    }
    function select_gallery(Request $request){
       $product_id = $request->pro_id;
       $gallery = Gallery::where('product_id', $product_id)->get();
       $gallery_count = $gallery->count();
       $output ='
       <table class="table table-striped">
       <thead>
           <tr>
               <th scope="col">#</th>
               <th scope="col">Tên hình ảnh</th>
               <th scope="col">Hình ảnh</th>
               <th scope="col">Cập nhật hình ảnh</th>
               <th scope="col">Ngày tạo</th>
               <th scope="col" class="text-center">Thao tác</th>
           </tr>
       </thead>
       <tbody>';
       if($gallery_count > 0){
        $i = 0;
        foreach($gallery as $gal){
            $output .= '<tr>
            <th scope="row">'.++$i.'</th>
            <td contenteditable class="edit_gal_name" data-gal_id = "'.$gal->id.'" >'.$gal->gallery_name.'</td>
            <td><img src="'.url('public/uploads/gallery/'.$gal->gallery_image).'" style="width:80px; height:auto">
            </td>
            <td><input type="file" name="file" id="file-'.$gal->id.'" class="file_image" style="width:40%" data-gal_id = "'.$gal->id.'" accept="image/*" /></td>
            <td>'.$gal->created_at.'</td>
            <td class="text-center">
                <button data-gal_id = "'.$gal->id.'" class="btn btn-danger btn-sm rounded-0 text-white  delete-gallery" type="button" data-toggle="tooltip" data-placement="top" title="Xóa ảnh"><i class="fa fa-trash"></i></button>
            </td>
        </tr>';
        }
       }else{
        $output .= '<tr>
        <th colspan="5">Sản phẩm này chưa có thư viện ảnh</th>
    </tr>
    ';
    $output .= '
         </tbody>
         </table>
    ';
       }
       echo $output;
    }
    function store(Request $request,$id){
        $get_image = $request->file('file');
        if($get_image){
            foreach($get_image as $image){
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$image->getClientOriginalName();
                $image->move('public/uploads/gallery',$new_image);
                $gallery = new Gallery();
                $gallery->gallery_name = $new_image;
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $id;
                $gallery->save();
            }
        }
        Toastr::success('Thêm mới thư viện ảnh thành công', 'Thông báo');
        return redirect()->back();
    }
    function update_name(Request $request){
        $gal_id = $request->gal_id;
        $gal_text = $request->gal_text;
        $gallery = Gallery::find($gal_id);
        $gallery->gallery_name = $gal_text;
        $gallery->save();
        Toastr::success('Chỉnh sửa tên ảnh thành công', 'Thông báo');
    }
    function delete(Request $request){
        $gal_id = $request->gal_id;
        $gallery = Gallery::find($gal_id);
        unlink('public/uploads/gallery/'.$gallery->gallery_image);
        $gallery->delete();
    }
    function update(Request $request){
        $get_image = $request->file('file');
        $gal_id = $request->gal_id;
        if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalName();
                $get_image->move('public/uploads/gallery',$new_image);
                $gallery = Gallery::find($gal_id);
                unlink('public/uploads/gallery/'.$gallery->gallery_image);
                $gallery->gallery_image = $new_image;
                $gallery->save();
        }
    }
}
