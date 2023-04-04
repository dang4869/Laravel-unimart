@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách sản phẩm</h5>
                <div class="form-search form-inline">
                    <form action="#" style="display: flex">
                        <input type="" class="form-control form-search mr-3" name="keyword" placeholder="Tìm kiếm"
                            value="{{ request()->input('keyword') }}">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'public']) }}" class="text-primary">Công khai<span
                            class="text-muted">({{ $count[0] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}" class="text-primary">Chờ duyệt<span
                            class="text-muted">({{ $count[1] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'featured']) }}" class="text-primary">Sản phẩm nổi
                        bật<span class="text-muted">({{ $count[2] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'selling']) }}" class="text-primary">Sản phẩm bán
                        chạy<span class="text-muted">({{ $count[3] }})</span></a>
                </div>
                <form action="{{ url('admin/product/action') }}">
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="" name="act">
                            <option>Chọn</option>
                            @if ($status == '')
                                <option value="delete">Xóa sản phẩm</option>
                                <option value="public">Công khai</option>
                                <option value="pending">Chờ duyệt</option>
                            @endif
                            @if ($status == 'public')
                                <option value="delete">Xóa sản phẩm</option>
                                <option value="pending">Chờ duyệt</option>
                            @endif
                            @if ($status == 'pending')
                                <option value="delete">Xóa sản phẩm</option>
                                <option value="public">Công khai</option>
                            @endif
                            @if ($status == 'featured' || $status == 'selling' )
                                <option value="delete">Xóa sản phẩm</option>
                                <option value="0">Không thuộc tính</option>
                            @endif

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
                                <th scope="col">Thư viện ảnh</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Người tạo</th>
                                <th scope="col">Kho hàng và màu sắc</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thuộc tính</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->total() > 0)
                                @foreach ($products as $product)
                                    <tr class="">
                                        <td>
                                            <input type="checkbox" name="list_check[]" value="{{ $product->id }}">
                                        </td>
                                        <td>{{ ++$i }}</td>
                                        <td><img src="{{ $product->imageUrl() }}" alt="" style="width:80px"></td>
                                        <td><a href="{{ route('admin.gallery.add', $product->id) }}">Thêm thư viện ảnh</a></td>
                                        <td style="width:200px"><a href="#">{{ $product->product_name }}</a></td>
                                        <td>{{ number_format($product->price) }}đ</td>
                                        <td>{{ $product->category_product->category_name }}</td>
                                        <td>{{ $product->user->name }}</td>
                                        <td><a href="{{ route('admin.color.show', $product->id) }}">Kho hàng và màu sắc</a></td>
                                        @if ($product->product_status == 0)
                                            <td><span class="badge badge-danger">Chờ duyệt</span></td>
                                        @endif
                                        @if ($product->product_status == 1)
                                            <td><span class="badge badge-success">Công khai</span></td>
                                        @endif
                                        @if ($product->properties == 0)
                                            <td><span class="badge badge-secondary">Không</span></td>
                                        @endif
                                        @if ($product->properties == 1)
                                            <td><span class="badge badge-primary">Nổi bật</span></td>
                                        @endif
                                        @if ($product->properties == 2)
                                            <td><span class="badge badge-warning">Bán chạy</span></td>
                                        @endif
                                        <td>
                                            <a href="{{ route('admin.product.edit', $product->id) }}"
                                                class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.product.delete', $product->id) }}"
                                                class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="bg-white">
                                        <p>Không tìm thấy sản phẩm nào</p>
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </form>
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
