<table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
    style="border-collapse:collapse;border:1px solid #cccccc">
    <tbody>
        <tr>
            <td align="center" bgcolor="#f12a43" style="padding:40px 0 30px 0;border:1px solid #cccccc">
                <img src="{{ asset('images/logo.png') }}"
                    alt="ismart.com" width="256" height="37" style="display:block" class="CToWUd"
                    data-bit="iit">
            </td>
        </tr>

        <tr>
            <td bgcolor="#ffffff" style="padding:40px 30px 40px 30px">



                <table border="0" cellpadding="0" cellspacing="0" width="100%"
                    style="border-collapse:collapse;font-family:Arial,sans-serif">
                    <tbody>
                        <tr>
                            <td style="color:#00483d;font-family:Arial,sans-serif">
                                <h1 style="font-size:24px;margin:10px 0">THÔNG TIN ĐƠN HÀNG SỐ <strong
                                        style="color:red">{{ $order->order_code }}</strong></h1>
                            </td>
                        </tr>
                        <tr>
                            <td style="color:#00483d;font-family:Arial,sans-serif">
                                <h2 style="font-size:20px;margin:10px 0">1. Thông tin người đặt hàng</h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table border="0" cellpadding="6" cellspacing="0" width="100%"
                                    style="border-collapse:collapse;font-family:Arial,sans-serif;font-size:14px">
                                    <tbody>
                                        <tr style="border-bottom:1px dotted #ccc">
                                            <td style="width:110px">Họ tên</td>
                                            <td>{{ $order->order_name }}</td>
                                        </tr>
                                        <tr style="border-bottom:1px dotted #ccc">
                                            <td>Điện thoại</td>
                                            <td>{{ $order->phone }}</td>
                                        </tr>
                                        <tr style="border-bottom:1px dotted #ccc">
                                            <td>Email</td>
                                            <td><a href="mailto:dang48691216@gmail.com"
                                                    target="_blank">{{ $order->email }}</a></td>
                                        </tr>
                                        <tr style="border-bottom:1px dotted #ccc">
                                            <td>Địa chỉ</td>
                                            <td>{{ $order->address }}</td>
                                        </tr>
                                        <tr style="border-bottom:1px dotted #ccc">
                                            <td>Phương thức</td>
                                            <td>Thanh toán khi nhận hàng</td>
                                        </tr>
                                        <tr style="border-bottom:1px dotted #ccc">
                                            <td>Vận chuyển</td>
                                            <td>Miễn phí vận chuyển</td>
                                        </tr>

                                        <tr style="border-bottom:1px dotted #ccc">
                                            <td>Ghi chú đặt hàng</td>
                                            <td>{{ $order->notes }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </td>
                        </tr>


                        <tr>
                            <td style="color:#153643;font-family:Arial,sans-serif">

                                <h2 style="font-size:20px;margin:10px 0">2. Sản phẩm đặt hàng</h2>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <table border="1" cellpadding="6" cellspacing="0" width="100%"
                                    style="border-collapse:collapse;font-family:Arial,sans-serif;font-size:14px">
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên sản phẩm</th>
                                            <th>SL</th>
                                            <th>Giá tiền</th>
                                            <th>Tổng (SLxG)</th>
                                        </tr>
                                        @php
                                            $t = 0;
                                        @endphp
                                        @foreach ($order_detail as $item)
                                            @php
                                                $t++;
                                            @endphp
                                            <tr>
                                                <td align="center">{{ $t }}</td>
                                                <td>
                                                    <p><strong>{{ $item->product_name }} - {{ $item->color }}</strong>
                                                    </p>
                                                </td>
                                                <td align="center">{{ $item->product_qty }}</td>
                                                <td align="center">
                                                    {{ number_format($item->product_price, 0, '', '.') }}đ</td>
                                                <td align="center">{{ number_format($item->total, 0, '', '.') }}đ</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4" align="right">Tổng tiền thanh toán:</td>
                                            <td><strong>{{number_format($order->price_total, 0, '', '.')}}đ</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:10px 0;font-family:Arial,sans-serif;font-size:14px">
                                <p>Cám ơn bạn đã đặt hàng. Đơn hàng đang được tiếp nhận và đang chờ xử lý.</p>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </td>
        </tr>

        <tr>
            <td bgcolor="#00483D" style="padding:30px 30px">

            </td>
        </tr>
    </tbody>
</table>
