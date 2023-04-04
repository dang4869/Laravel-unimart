@extends('layouts.frontend')

@section('content')
    <div id="main-content-wp" class="checkout-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="?page=home" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Thanh toán</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            <form action="{{ url('checkout/store') }}" method="POST" class="clearfix">
                @csrf
                <div class="section" id="customer-info-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin khách hàng</h1>
                    </div>
                    <div class="section-detail">
                        <div class="form-row ">
                            <div class="form-col">
                                <label for="fullname">Họ tên <span style="color: red">(*)</span></label>
                                <input type="text" name="order_name" id="fullname" class="form-control">
                                @error('order_name')
                                    <small class="form-text text-danger" style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-col ">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <label for="province">Tỉnh, Thành phố <span style="color: red">(*)</span></label>
                                <select name="province" id="province" class="form-select" data-url="{{ url('select/province') }}">
                                    <option value="">Chọn tỉnh thành phố</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->province_id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                                @error('province')
                                    <small class="form-text text-danger" style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-col">
                                <label for="district">Quận, huyện <span style="color: red">(*)</span></label>
                                <select name="district" id="district" class="form-select" data-url="{{url('select/wards')}}">
                                    <option value="">Chọn một quận/huyện</option>
                                </select>
                                @error('district')
                                    <small class="form-text text-danger" style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-col">
                                <label for="wards">Phường, xã <span style="color: red">(*)</span></label>
                                <select name="wards" id="wards" class="form-select">
                                    <option value="">Chọn một phường/xã</option>
                                </select>
                                @error('wards')
                                    <small class="form-text text-danger" style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-col ">
                                <label for="address">Địa chỉ <span style="color: red">(ghi rõ số nhà, thôn xóm *)</span></label>
                                <input type="text" name="address" id="address">
                                @error('address')
                                    <small class="form-text text-danger" style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-col ">
                                <label for="phone">Số điện thoại <span style="color: red">(*)</span></label>
                                <input type="tel" name="phone" id="phone">
                                @error('phone')
                                    <small class="form-text text-danger" style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <label for="notes">Ghi chú</label>
                                <textarea name="notes"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section" id="order-review-wp">
                    <div class="section-head">
                        <h1 class="section-title">Thông tin đơn hàng</h1>
                    </div>
                    <div class="section-detail">
                        <table class="shop-table">
                            <thead>
                                <tr>
                                    <td>Sản phẩm</td>
                                    <td>Tổng</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $item)
                                    <tr class="cart-item">
                                        <td class="product-name">{{ $item->name }}<strong
                                                class="product-quantity">({{ $item->options->color }}) x
                                                {{ $item->qty }}</strong></td>
                                        <td class="product-total">{{ number_format($item->total, 0, '', '.') }}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="order-total">
                                    <td>Tổng đơn hàng:</td>
                                    <td><strong class="total-price">{{number_format(Cart::total(), 0,'','.')}}đ</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div id="payment-checkout-wp">
                            <ul id="payment_methods">
                                <li>
                                    <input type="radio" checked id="payment-home" name="payment" value="1">
                                    <label for="payment-home">Thanh toán tại nhà</label>
                                </li>
                            </ul>
                        </div>
                        <div id="payment-checkout-wp">
                            <ul id="payment_methods">
                                <li>
                                    <input type="radio"  id="payment-onl" name="payment" value="2">
                                    <label for="payment-onl">Thanh toán online(vnpay)</label>
                                </li>
                            </ul>
                        </div>
                        <div class="place-order-wp clearfix">
                            <input type="submit" id="order-now" value="Đặt hàng">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
