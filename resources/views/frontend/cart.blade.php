@extends('layouts.frontend')

@section('content')
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}/" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <form action="POST" data-url="{{ url('cart/update') }}" id="form-add">
            @csrf
        @if (Cart::Count()>0)
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>STT</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Màu sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t = 0;
                        @endphp
                        @foreach (Cart::content() as $row)
                        @php
                            $t++;
                        @endphp
                        <tr>
                            <td>{{$t}}</td>
                            <td>
                                <a href="" title="" class="thumb">
                                    <img src="{{$row->options->thumbnail}}" alt="">
                                </a>
                            </td>
                            <td>
                                <a href="" title="" class="name-product">{{$row->name}}</a>
                            </td>
                            <td>{{$row->options->color}}</td>
                            <td class="price-{{$row->rowId}}" name="price" data-price="{{$row->price}}">{{number_format($row->price, 0, '','.')}}đ</td>
                            <td>
                                <input type="number" min="1" name="qty" value="{{$row->qty}}" class="num-order" data-id="{{$row->rowId}}">
                            </td>
                            <td id="sub-total-{{$row->rowId}}">{{number_format($row->total, 0, '','.')}}đ</td>
                            <td>
                                <a href="{{route('cart.remove', $row->rowId)}}" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right" style="color: #ad0000">Tổng giá: <span>{{number_format(Cart::total(), 0,'','.')}}</span>đ</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <a href="{{url('thanh-toan')}}" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="{{url('home/show')}}" title="" id="buy-more">Mua tiếp</a><br/>
                <a href="{{url('cart/destroy')}}" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
        @else
            <span>Hiện không có sản phẩm nào trong giỏ hàng</span>
        @endif
    </form>
    </div>
</div>
@endsection
