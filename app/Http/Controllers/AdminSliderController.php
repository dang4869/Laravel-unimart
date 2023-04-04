<?php

namespace App\Http\Controllers;

use App\Slider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AdminSliderController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'slider']);
            return $next($request);
        });
    }
    function list()
    {
        $sliders = Slider::orderby('id','DESC')->paginate(10);
        return view('admin.slider.list',compact('sliders'))->with('i',(request()->input('page',1)-1)*10);
    }
    function store(Request $request)
    {
        $input = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file;
            //    Lấy tên file
            $filename = $file->getClientOriginalName();

            // Lấy đuôi file
            // echo $file->getClientOriginalExtension();
            // Lấy kích thước file
            // echo $file->getSize();
            // Upload file lên server
            $path = $file->move('public/uploads/slider', $file->getClientOriginalName());
            $thumbnail = 'public/uploads/slider/' . $filename;

            $input['thumbnail'] = $thumbnail;
            $input['name'] = $filename;

        }
        Slider::create($input);
        Toastr::success('Thêm mới slider thành công', 'Thông báo');
        return redirect()->back();
    }
    function select_slider(Request $request){
        $sliders = Slider::orderby('id','DESC')->get();
        $slider_count = $sliders->count();
        $output = '<table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Cập nhật hình ảnh</th>
                <th scope="col">Tác vụ</th>
            </tr>
        </thead>
        <tbody>';
        if($slider_count > 0){
            $i = 0;
            foreach($sliders as $slider){
                $output .= '<tr>
                <th scope="row">'.++$i.'</th>
                <td><img src="'.url($slider->thumbnail).'" alt="" style="width:80px"></td>
                <td><input type="file" name="file" id="file-'.$slider->id.'" class="file_image_slider" style="width:40%" data-slider_id = "'.$slider->id.'" accept="image/*" /></td>
                <td><a data-slider_id = "'.$slider->id.'" class="btn btn-danger btn-sm rounded-0 text-white delete-slider" type="button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></a></td>
            </tr>';
            }
        }else{
            $output .= '<tr>
            <th>Không có hình ảnh nào</th>
            </tr>';
            $output .= '</tbody>
            </table>
            ';
        }
        echo $output;
    }
    function delete(Request $request){
        $slider_id = $request->slider_id;
        $slider = Slider::find($slider_id);
        $slider_image = $slider->thumbnail;
        if($slider_image){
          unlink($slider_image);
        }
        $slider->delete();
    }
    function update(Request $request){
        $get_image = $request->file('file');
        $slider_id = $request->slider_id;
        if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalName();
                $get_image->move('public/uploads/slider',$new_image);
                $slider = Slider::find($slider_id);
                unlink($slider->thumbnail);
                $slider->thumbnail = 'public/uploads/slider/'.$new_image;
                $slider->save();
        }
    }
}
