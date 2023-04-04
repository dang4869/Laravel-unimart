@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm sản phẩm
            </div>
            <div class="card-body">
                <form action="{{ url('admin/product/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="slug">Tên sản phẩm</label>
                                <input class="form-control" type="text" name="product_name" id="slug" onkeyup="ChangeToSlug()">
                                @error('product_name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="convert_slug">Link thân thiện</label>
                                <input class="form-control" type="text" name="slug" id="convert_slug">
                                @error('slug')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Giá</label>
                                <input class="form-control" type="text" name="price" id="price">
                                @error('price')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="intro">Mô tả sản phẩm</label>
                                <textarea name="product_desc" class="form-control" id="intro" cols="30" rows="5"></textarea>
                                @error('product_desc')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="intro">Chi tiết sản phẩm</label>
                        <textarea name="product_detail" class="form-control" id="intro" cols="30" rows="5"></textarea>
                        @error('product_detail')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Ảnh sản phẩm</label>
                        <input type="file" class="form-control-file" id="image" name="file">
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục <span style="color: red">(Chỉ chọn danh mục cấp bé
                                nhất)</span></label>
                        <select class="form-control" id="" name="category_product_id">
                            <option value="0">Chọn danh mục</option>
                            @foreach ($category as $val)
                              {{-- @if ($val->category_parent == 0)
                                  <option value="{{$val->id}}">{{$val->category_name}}</option>
                              @endif --}}
                                <option value="{{ $val->id }}">
                                    @php
                                        $str = '';
                                        for ($i = 0; $i < $val->level; $i++) {
                                            echo $str;
                                            $str .= '|--';
                                        }
                                    @endphp
                                    {{ $val->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category_product_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="product_status" id="exampleRadios1"
                                value="0" >
                            <label class="form-check-label" for="exampleRadios1">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="product_status" id="exampleRadios2"
                                value="1" checked>
                            <label class="form-check-label" for="exampleRadios2">
                                Công khai
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Thuộc tính sản phẩm</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="properties" id="exampleRadios3"
                                value="0" checked>
                            <label class="form-check-label" for="exampleRadios3">
                                Không
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="properties" id="exampleRadios4"
                                value="1" >
                            <label class="form-check-label" for="exampleRadios4">
                                Sản phẩm nổi bật
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="properties" id="exampleRadios5"
                                value="2">
                            <label class="form-check-label" for="exampleRadios5">
                                Sản phẩm bán chạy
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
