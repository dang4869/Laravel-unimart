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
                        <form action="{{ url('admin/category-post/store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên danh mục</label>
                                <input class="form-control" type="text" name="name" id="name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                        value="option1">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Chờ duyệt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                        value="option2" checked>
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
                                    <th scope="col">STT</th>
                                    <th scope="col" style="text-align: center">Danh mục bài viết</th>
                                    <th scope="col" style="text-align: center">Ngày tạo</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php
                                    $t = 0;
                                @endphp --}}
                                @foreach ($category_posts as $category_post)
                                    <tr>
                                        <th scope="row">{{ ++$i }}</th>
                                        <td style="text-align: center">{{ $category_post->category_post }}</td>
                                        <td style="text-align: center">{{ $category_post->created_at }}</td>
                                        <td><a href="{{route('admin.category_post.edit', $category_post->id)}}"
                                            class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Chỉnh sửa">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                            <a href="{{ route('admin.category_post.delete', $category_post->id) }}"
                                                onclick="return confirm('Bạn có muốn xóa danh mục này không ?')"
                                                class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Xóa danh mục">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </div>
                        </table>
                        {{$category_posts->links()}}
                </div>
            </div>
        </div>

    </div>
@endsection
