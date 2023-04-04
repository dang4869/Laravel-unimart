@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách bài viết</h5>
                <div class="form-search form-inline">
                    <form action="#" style="display:flex">
                        <input type="" class="form-control form-search mr-3" name="keyword"
                            value="{{ request()->input('keyword') }}" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/post/action') }}" method="">
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="" name="act">
                            <option>Chọn</option>
                            <option value="delete">Xóa bài viết</option>
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </div>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input name="checkall" type="checkbox">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{ $post->id }}">
                                    </td>
                                    <td scope="row">{{ ++$i }}</td>
                                    <td><img src="{{ $post->imageUrl() }}" alt="" style="width:80px; height:auto">
                                    </td>
                                    <td><a href="">{{ $post->title }}</a></td>
                                    <td><a href="">{{ $post->slug }}</a></td>
                                    <td>{{ $post->category_post->category_post }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td><a href="{{route('admin.post.edit', $post->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="{{ route('admin.post.delete', $post->id) }}"
                                            class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Xóa bài viết"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
            {{ $posts->links() }}
        </div>
    </div>
@endsection
