@extends('layouts.frontend')

@section('content')
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Tìm kiếm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            @if ($products->count()>0)
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Kết quả Tìm kiếm : {{ request()->input('keyword') }}</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($products as $product)
                        <li>
                            <a href="?page=detail_product" title="" class="thumb">
                                <img src="{{url($product->thumbnail)}}" style="height:160px">
                            </a>
                            <a href="?page=detail_product" title="" class="product-name">{{$product->product_name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($product->price, 0, '','.')}}đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="section" id="paging-wp">
                <div class="section-detail">
                    {{$products->links()}}
                </div>
            </div>
            @else
                Không tìm được sản phẩm nào
            @endif

        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                        @foreach ($categorys as $item)
                        <li>
                            <a href="{{route('category.product', $item->slug)}}" title="">{{$item->category_name}}</a>
                            @include('frontend.menu.child', ['item'=>$item])
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .pagination{
        display: flex;
        justify-content: center
    }
    .pagination li{
        font-size: 20px;
        padding: 10px 13px;
       background: wheat;
       margin-right: 5px;
       color: aliceblue
    }
    .active{
        background: tomato !important
    }
</style>
@endsection
