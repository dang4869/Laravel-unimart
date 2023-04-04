@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm thư viện ảnh
                </div>
                <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
                <div class="card-body">
                    <form action="{{url('admin/gallery/store/'.$pro_id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="form-group">
                            <label for="name">Tên hình ảnh</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div> --}}
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="file">Hình ảnh</label>
                                    <input class="form-control-file" type="file" name="file[]" id="file" accept="image/*" multiple>
                                    <span id="error_gallery"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary  mt-4">Thêm mới</button>
                            </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh mục
                </div>
                <form action="">
                    @csrf
                    <div id="table" data-url="{{url('admin/gallery/update/gallery-name')}}">

                    </div>
                    <div id="delete" data-url="{{url('admin/gallery/delete')}}">

                    </div>
                    <div id="update" data-url="{{url('admin/gallery/update')}}"></div>
                <div class="card-body" id="gallery-load" data-url="{{url('admin/product/select-gallery')}}">

                </div>
            </form>
            </div>
        </div>
    </div>

</div>
@endsection
