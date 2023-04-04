@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thông tin khách hàng
            </div>
            <div class="card-body">
                <table class="table table-striped table-checkall">
                    <tbody><tr>
                        <td>Mã đơn hàng:</td>
                        <td colspan="2">{{$order->order_code}}</td>
                    </tr>
                    <tr>
                        <td>Tên khách hàng:</td>
                        <td colspan="2">{{$order->order_name}}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td colspan="2">{{$order->email}}</td>
                    </tr>
                    <tr>
                        <td>Địa chỉ:</td>
                        <td colspan="2">{{$province->name}}, {{$district->name}}, {{$wards->name}}, {{$order->address}}</td>
                    </tr>
                    <tr>
                        <td>Số điện thoại:</td>
                        <td colspan="2">{{$order->phone}}</td>
                    </tr>
                    <tr>
                        <td>Ngày tạo:</td>
                        <td colspan="2">{{$order->created_at}}</td>
                    </tr>
                    <tr>
                        <td>Ghi chú:</td>
                        <td colspan="2">{{$order->notes}}</td>
                    </tr>
                    <tr>
                        <td>
                            <h6 class="text-uppercase font-weight-bold">Tổng tiền:</h6>
                        </td>
                        <td>
                            <h6 class="text-uppercase font-weight-bold">{{number_format($order->price_total, 0, '', '.')}}đ</h6>
                        </td>
                    </tr>
                </tbody></table>
                <form class="form-inline" action="{{route('admin.order.update', $order->id)}}" method="POST">
                    @csrf
                    <div class="form-group mb-2">
                      <label>Cập nhật trạng thái</label>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select class="form-control" name="order_status">
                            @foreach ($list_status as $k => $act)
                         <option value="{{$k}}" @if ($order->order_status == $k) selected
                            @endif>{{$act}}</option>
                            @endforeach

                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 mr-3" value="status_update" name="status_update_btn">Cập nhật</button>
                  </form>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header font-weight-bold">
                Chi tiết đơn hàng
            </div>
            <div class="card-body">
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Màu</th>
                            <th scope="col">Tổng</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_detail as $item)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>
                                <img src="{{url($item->thumbnail)}}" alt=""
                                    height="auto" width="80px">
                            </td>
                            <td><a href="">{{$item->product_name}}</a></td>
                            <td>{{number_format($item->product_price, 0,'','.')}}đ</td>
                            <td>{{$item->product_qty}}</td>
                            <td>{{$item->color}}</td>
                            <td>{{number_format($item->total, 0, '','.')}}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
