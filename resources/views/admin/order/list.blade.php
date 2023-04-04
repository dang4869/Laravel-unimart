@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách đơn hàng</h5>
            <div class="form-search form-inline">
                <form action="#" style="display: flex">
                    <input type="" class="form-control form-search mr-3" placeholder="Tìm kiếm" name="keyword" value="{{ request()->input('keyword') }}">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <form action="{{url('admin/order/action')}}" method="post">
                @csrf
            <div class="analytic">
                <a href="{{ request()->fullUrlWithQuery(['status' => 'loading']) }}" class="text-primary" >Đang xử lý<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'delivery']) }}" class="text-primary">Đang giao hàng<span class="text-muted">({{$count[1]}})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'success']) }}" class="text-primary">Hoàn thành<span class="text-muted">({{$count[2]}})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'cancelled']) }}" class="text-primary">Đã hủy<span class="text-muted">({{$count[3]}})</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="" name="act">
                    @if ($status == '')
                    <option>Chọn</option>
                    <option value="loading">Đang xử lý</option>
                    <option value="delivery">Đang giao hàng</option>
                    <option value="success">Hoàn thành</option>
                    <option value="cancelled">Đã hủy</option>
                    <option value="delete">Xóa đơn hàng</option>
                    @endif
                    @if ($status == 'loading')
                    <option>Chọn</option>
                    <option value="delivery">Đang giao hàng</option>
                    <option value="success">Hoàn thành</option>
                    <option value="cancelled">Đã hủy</option>
                    <option value="delete">Xóa đơn hàng</option>
                    @endif
                    @if ($status == 'delivery')
                    <option>Chọn</option>
                    <option value="loading">Đang xử lý</option>
                    <option value="success">Hoàn thành</option>
                    <option value="cancelled">Đã hủy</option>
                    <option value="delete">Xóa đơn hàng</option>
                    @endif
                    @if ($status == 'success')
                    <option>Chọn</option>
                    <option value="loading">Đang xử lý</option>
                    <option value="delivery">Đang giao hàng</option>
                    <option value="cancelled">Đã hủy</option>
                    <option value="delete">Xóa đơn hàng</option>
                    @endif
                    @if ($status == 'cancelled')
                    <option>Chọn</option>
                    <option value="loading">Khôi phục</option>
                    <option value="delete">Xóa đơn hàng</option>
                    @endif
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">STT</th>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thanh toán</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>
                            <input type="checkbox" name="list_check[]" value="{{$order->id}}">
                        </td>
                        <td>{{++$i}}</td>
                        <td>{{$order->order_code}}</td>
                        <td>
                            {{$order->order_name}}
                        </td>
                        <td> {{$order->phone}}</td>
                        <td>{{number_format($order->price_total, 0,'','.')}}đ</td>
                        @if ($order->order_status == 0)
                        <td><span class="badge badge-warning">Đang xử lý</span></td>
                        @endif
                        @if ($order->order_status == 1)
                        <td><span class="badge badge-primary">Đang vận chuyển</span></td>
                        @endif
                        @if ($order->order_status == 2)
                        <td><span class="badge badge-success">Hoàn thành</span></td>
                        @endif
                        @if ($order->order_status == 3)
                        <td><span class="badge badge-danger">Đã hủy</span></td>
                        @endif
                        @if ($order->payment == 2)
                        <td><span class="badge badge-success">Đã thanh toán online</span></td>
                        @endif
                        @if ($order->payment == 1)
                        <td><span class="badge badge-primary">Thanh toán khi nhận hàng</span></td>
                        @endif
                        <td>{{$order->created_at}}</td>
                        <td>
                            <a href="{{route('admin.order.detail', $order->id)}}" class="btn btn-primary btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Chi tiết đơn hàng"><i class="fa-solid fa-ellipsis"></i></i></a>
                            <a href="{{route('admin.order.delete', $order->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Xóa đơn hàng"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{$orders->links()}}
        </div>
    </form>
    </div>
</div>
@endsection
