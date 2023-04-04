@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách bài viết</h5>
                <div class="form-search form-inline">
                    <form action="#" style="display: flex">
                        <input type="" class="form-control form-search mr-3" placeholder="Tìm kiếm" name="keyword"
                            value="{{ request()->keyword }}">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/page/action') }}" method="">
                    {{-- <div class="analytic">
                        <a href="" class="text-primary">Trạng thái 1<span class="text-muted">(10)</span></a>
                        <a href="" class="text-primary">Trạng thái 2<span class="text-muted">(5)</span></a>
                        <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a>
                    </div> --}}
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
                                <th scope="col">STT</th>
                                <th scope="col">Tiêu đề trang</th>
                                <th scope="col">slug</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $page)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{ $page->id }}">
                                    </td>
                                    <td scope="row">{{ ++$i }}</td>
                                    <td><a href="">{{ $page->name_page }}</a></td>
                                    <td>{{ $page->slug }}</td>
                                    <td>{{ $page->created_at }}</td>
                                    <td><a href="{{route('admin.page.edit',$page->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Cập nhật trang"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="{{ route('admin.page.delete', $page->id) }}"
                                            class="btn btn-danger btn-sm rounded-0  text-white" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Xóa trang"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pages->links() }}
            </div>
            </form>
        </div>
    </div>
@endsection
