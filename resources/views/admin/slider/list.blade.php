@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm mới slider
                </div>
                <div class="card-body">
                    <form action="{{route('admin.slider.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="image">Hình ảnh</label>
                                    <input class="form-control-file" type="file" name="file" id="image">
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách
                </div>
                <div id="delete_slider" data-url="{{url('admin/slider/delete')}}">

                </div>
                <div id="update_slider" data-url="{{url('admin/slider/update')}}">

                </div>
                <div class="card-body" id="slider-load" data-url="{{url('admin/slider/select-slider')}}">
                    {{-- <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Cập nhật hình ảnh</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                            <tr>
                                <th scope="row">{{++$i}}</th>
                                <td><img src="{{url($slider->thumbnail)}}" alt="" style="width:80px"></td>
                                <td><input type="file" name="file" id="file-{{$slider->id}}" class="file_image_slider" style="width:40%" data-slider_id = "{{$slider->id}}" accept="image/*" /></td>
                                <td><a href="{{route('admin.slider.delete', $slider->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> --}}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
