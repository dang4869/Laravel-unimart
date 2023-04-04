@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhật sản phẩm
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="slug">Tên sản phẩm</label>
                                <input class="form-control" type="text" name="product_name" id="slug" value="{{$product->product_name}}" onkeyup="ChangeToSlug()">
                                @error('product_name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="convert_slug">Link thân thiện</label>
                                <input class="form-control" type="text" name="slug" id="convert_slug" value="{{$product->slug}}">
                                @error('product_name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Giá</label>
                                <input class="form-control" type="text" name="price" id="price" value="{{$product->price}}">
                                @error('price')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                      </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="intro">Mô tả sản phẩm</label>
                                <textarea name="product_desc" class="form-control" id="intro" cols="30" rows="5">{!!$product->product_desc!!}</textarea>
                                @error('product_desc')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="intro">Chi tiết sản phẩm</label>
                        <textarea name="product_detail" class="form-control" id="intro" cols="30" rows="5">{!!$product->product_detail!!}</textarea>
                        @error('product_detail')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Ảnh sản phẩm <span style="color: red">(Nếu muốn thay đổi ảnh thì hãy click vào chọn tệp)</span></label>
                        <input type="file" class="form-control-file" id="image" name="file">
                        <img src="{{$product->imageUrl()}}" alt="" style="width:80px">
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục <span style="color: red">(Chỉ chọn danh mục cấp bé
                                nhất)</span></label>
                        <select class="form-control" id="" name="category_product_id">
                            <option value="0">Chọn danh mục</option>
                            @foreach ($category as $val)
                                <option value="{{ $val->id }}" @if ($product->category_product_id == $val->id) selected @endif>
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
                            <input class="form-check-input" type="radio" id="exampleRadios1"
                                value="0" name="product_status" @if ($product->product_status == 0) checked @endif>
                            <label class="form-check-label" for="exampleRadios1">
                                Chờ duyệt
                            </label>
                            {{-- @error('product_status')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror --}}
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="exampleRadios2"
                                value="1" name="product_status" @if ($product->product_status == 1) checked @endif>
                            <label class="form-check-label" for="exampleRadios2">
                              Công khai
                            </label>
                            {{-- @error('product_status')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Thuộc tính sản phẩm</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="properties" id="exampleRadios1"
                                value="0" @if ($product->properties == 0) checked @endif>
                            <label class="form-check-label" for="exampleRadios1">
                                Không
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="properties" id="exampleRadios2"
                                value="1"@if ($product->properties == 1) checked @endif >
                            <label class="form-check-label" for="exampleRadios2">
                                Sản phẩm nổi bật
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="properties" id="exampleRadios2"
                                value="2" @if ($product->properties == 2) checked @endif>
                            <label class="form-check-label" for="exampleRadios2">
                                Sản phẩm bán chạy
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
