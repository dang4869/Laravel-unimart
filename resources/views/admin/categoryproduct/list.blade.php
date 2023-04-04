@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Thêm danh mục
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/category-product/store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="slug">Tên danh mục</label>
                                <input class="form-control" type="text" name="name" id="slug" onkeyup="ChangeToSlug()">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="convert_slug">Link thân thiện</label>
                                <input class="form-control" type="text" name="slug" id="convert_slug">
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Danh mục cha</label>
                                <select class="form-control" id="" name="category_parent">
                                    <option value="0">Danh mục cha</option>
                                    @foreach ($category as $val)
                                    <option value="{{$val->id}}">
                                     @php
                                         $str = '';
                                         for($i = 0; $i<$val->level; $i++){
                                            echo $str;
                                            $str .= '|--';
                                         }
                                     @endphp
                                     {{$val->category_name}}</option>
                                    @endforeach
                                </select>
                                @error('category_parent')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                        value="1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Chờ duyệt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                        value="0">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Công khai
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh mục
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Tên danh mục</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $val)
                                <tr>
                                    <td>
                                     @php
                                         $str = '';
                                         for($i = 0; $i<$val->level; $i++){
                                            echo $str;
                                            $str .= '|---';
                                         }
                                     @endphp
                                    {{$val->category_name}}</td>
                                    <td>{{$val->slug}}</td>
                                    <td>{{$val->created_at}}</td>
                                    <td><a href="{{route('admin.categoryproduct.edit', $val->id)}}"
                                        class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Chỉnh sửa">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                        <a href="{{route('admin.categoryproduct.delete', $val->id)}}"
                                            onclick="return confirm('Bạn có muốn xóa danh mục này không ?')"
                                            class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Xóa danh mục">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- {{$category->link()}} --}}
            </div>
        </div>
    </div>
@endsection
