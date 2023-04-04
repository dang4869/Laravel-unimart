@extends('layouts.frontend')

@section('content')
<div class="pay-vnpay">

    <form action="{{url('checkout/vnpay')}}" method="post" class="form-vnpay">
        <h1 class="pay">Thông tin thanh toán</h1>
        @csrf
        <div class="form-group">
            <label for="name">Tên khách hàng</label>
            <input type="text" id="name" name="name" value="{{$order->order_name}}" class="form-select">
        </div>
       <div class="form-group">
            <label for="money">Số tiền</label>
            <input type="text" class="form-select" id="money" name="money" value="{{number_format(Cart::total(), 0, '', '.')}}đ" disabled>
       </div>
        <div class="form-col">
            <label for="bank_code">Ngân hàng</label>
            <select name="bank_code" id="bank_code" class="form-select">
                <option value="">Chọn ngân hàng</option>
                <option value="NCB">Ngân hàng NCB</option>
                <option value="AGRIBANK">Ngân hàng Agribank</option>
                <option value="SCB">Ngân hàng SCB</option>
                <option value="MBBANK">Ngân hàng MBBANK</option>
                <option value="SHB">Ngân hàng SHB</option>
                <option value="BIDV">Ngân hàng BIDV</option>
            </select>
        </div>
        <button type="submit" class="vnpay" name="redirect">Thanh toán</button>
    </form>
</div>
@endsection
<style>
    .pay{
        margin:20px 0px;
    }
    .pay-vnpay{
        height: 52vh;
        display: flex;
        justify-content: center;
    }
    .form-vnpay{
        width: 700px;
    }
    .form-group{
        padding-bottom: 10px;
    }
    .vnpay{
        color: white;
        background: #f12a43;
        border: none;
        margin-top: 20px;
        padding: 10px 20px;
        border-radius: 10px 10px;
    }
</style>
