@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($order_success, 0, '', '.') }}</h5>
                        <p class="card-text">Đơn hàng giao dịch thành công</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">ĐANG XỬ LÝ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($order_loading, 0, '', '.') }}</h5>
                        <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">DOANH SỐ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($total, 0, '', '.') }}đ</h5>
                        <p class="card-text">Doanh số hệ thống</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">ĐƠN HÀNG HỦY</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($order_cancel, 0, '', '.') }}</h5>
                        <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end analytic  -->
        <div class="card">
            <div class="card-header font-weight-bold">
                ĐƠN HÀNG MỚI
            </div>
            @php
                $user = Auth::user();
            @endphp
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Giá trị</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Thời gian</th>
                            @if ($user->can('admin.order.detail'))
                            <th scope="col">Tác vụ</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td>{{ $order->order_code }}</td>
                                <td>
                                    {{ $order->order_name }}
                                </td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ number_format($order->price_total, 0, '', '.') }}đ</td>
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
                                <td>{{ $order->created_at }}</td>
                                @if ($user->can('admin.order.detail'))
                                    <td>
                                        <a href="{{ route('admin.order.detail', $order->id) }}"
                                            class="btn btn-primary btn-sm rounded-0 text-white" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Chi tiết đơn hàng"><i
                                                class="fa-solid fa-ellipsis"></i></i></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>

    </div>
@endsection
