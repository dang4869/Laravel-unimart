@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Thêm màu sắc và số lượng:
                            <span style="color: blue">{{$product->product_name}}</span>

                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/product/color/store/'.$id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên màu</label>
                                <input class="form-control" type="text" name="name" id="name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="color-code">Mã màu</label>
                                <input class="form-control" type="color" name="color_code" id="color-code">
                                @error('color_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="amout">Số lượng</label>
                                <input class="form-control" type="text" name="amout" id="amout">
                                @error('amout')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                      Màu sắc và số lượng
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên màu</th>
                                    <th scope="col">Mã màu</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($colors as $col)
                                <tr>
                                    <th scope="row">{{++$i}}</th>
                                    <td>{{$col->name}}</td>
                                    <td>{{$col->color_code}}</td>
                                    <td>{{$col->amout}}</td>
                                    @if ($col->amout == 0)
                                    <td><span class="badge badge-danger">Hết hàng</span></td>
                                    @endif
                                    @if ($col->amout > 0)
                                    <td><span class="badge badge-success">Còn hàng</span></td>
                                    @endif
                                    <td><a href="{{route('admin.color.edit',$col->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="{{route('admin.color.delete',$col->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Xóa"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($color > 0)
                        <span class="font-weight-bold">Tổng số lượng sản phẩm: {{$total}}</span>
                        @else
                        <span class="font-weight-bold">Không có sản phẩm nào</span>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
