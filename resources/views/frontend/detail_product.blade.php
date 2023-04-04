@extends('layouts.frontend')

@section('content')
    <style>
        .container-color {
            display: flex;
            margin-bottom: 10px
        }

        .form-check {
            border: 1px solid;
            padding: 5px 10px;
            margin-right: 10px;
        }

        h1,
        h2 {
            margin-bottom: 15px;
            font-weight: bold
        }

        ul {
            margin-bottom: 15px
        }

        .view-more-container a {
            text-transform: uppercase;
            font-weight: bold;
            font-size: 15px;
            color: #00483d;
        }
    </style>
    <div id="main-content-wp" class="clearfix detail-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{url('trang-chu')}}" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="" >Chi tiết sản phẩm</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="detail-product-wp">
                    <div class="alert alert-danger" role="alert">
                        {{ session('status') }}
                    </div>
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left" style="position: relative">
                            <a href="" title="" id="main-thumb">
                                <img id="zoom" src="{{ $detail_product->imageUrl() }}"
                                    data-zoom-image="{{ $detail_product->imageUrl() }}" />
                            </a>
                            <div id="list-thumb">
                                @foreach ($img as $img_thumb)
                                    <a href=""
                                        data-image="{{ url('public/uploads/gallery/' . $img_thumb->gallery_image) }}"
                                        data-zoom-image="{{ url('public/uploads/gallery/' . $img_thumb->gallery_image) }}"
                                        style="365px">
                                        <img id="zoom"
                                            src="{{ url('public/uploads/gallery/' . $img_thumb->gallery_image) }}" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            {{-- <img src="{{asset('images/img-pro-01.png')}}" alt=""> --}}
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name">{{ $detail_product->product_name }}</h3>
                            <div class="desc">
                                {!! $detail_product->product_detail !!}
                            </div>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                {{-- @foreach ($color_amout as $item)
                                    <span class="status"
                                        style="background:{{ $item->color_code }}; color:#ffff">{{ $item->name }}({{ $item->amout }})</span>
                                @endforeach --}}
                                <span class="status">Còn hàng</span>
                            </div>
                            <p class="price">{{ number_format($detail_product->price, 0, '', '.') }}đ</p>
                            <form action="{{ route('cart.add', $detail_product->id) }}" method="post">
                                @csrf
                                <h4>Màu: </h4>
                                <div class="container-color">
                                    @foreach ($color_amout as $item)
                                        <div class="form-check form-check-inline color-item"
                                            style="background:{{ $item->color_code }}; color:#ffff">
                                            <input class="d-none form-check-input" type="radio" name="color"
                                                id="{{ $item->id }}" value="{{ $item->name }}"
                                                style="height:18px; width:18px; vertical-align: middle;" @if ($item->id == $min)
                                                    checked
                                                @endif>

                                            <label class="form-check-label color-name" for="{{ $item->id }}">
                                                {{ $item->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="num-order-wp">
                                    <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                    <input type="text" name="qty_num" value="1" id="num-order">
                                    <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                </div>
                                <button title="Thêm giỏ hàng" class="add-cart" style="border: none">Thêm giỏ hàng</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail">
                        <div class="detail" id="detail">
                            {!! $detail_product->product_desc !!}
                        </div>
                        <div class="view-more-container" style="padding: 8px 10px;
                    text-align: center;">
                            <a href="javascript:;" type="button" id="viewMoreContent" onclick="viewMore()">Xem thêm</a>
                        </div>
                    </div>

                </div>
                <div class="section" id="same-category-wp">
                    <div class="section-head">
                        <h3 class="section-title">Cùng chuyên mục</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($product_same as $same)
                                @if ($detail_product->id != $same->id)
                                    <li>
                                        <a href="{{ route('product.detail', $same->slug) }}" title="" class="thumb">
                                            <img src="{{ $same->imageUrl() }}">
                                        </a>
                                        <a href="{{ route('product.detail', $same->slug) }}" title=""
                                            class="product-name">{{ $same->product_name }}</a>
                                        <div class="price">
                                            <span class="new">{{ number_format($same->price, 0, '', '.') }}đ</span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
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
                                    <a href="{{ route('category.product', $item->slug) }}"
                                        title="">{{ $item->category_name }}</a>
                                    @include('frontend.menu.child', ['item' => $item])
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        <a href="" title="" class="thumb">
                            <img src="public/images/banner.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function viewMore() {
            if (document.getElementById("viewMoreContent").innerHTML == "Xem thêm") {
                document.getElementById("detail").style.height = "auto";
                document.getElementById("viewMoreContent").innerHTML = "Thu gọn";
            } else {
                document.getElementById("detail").style.height = "600px";
                document.getElementById("viewMoreContent").innerHTML = "Xem thêm";
            }
        }
    </script>
@endsection
