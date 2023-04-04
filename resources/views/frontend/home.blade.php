@extends('layouts.frontend')

@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    @foreach ($slider as $item)
                    <div class="item">
                        <img src="{{url($item->thumbnail)}}" alt="">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="{{asset('images/icon-1.png')}}">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('images/icon-2.png')}}">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('images/icon-3.png')}}">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('images/icon-4.png')}}">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('images/icon-5.png')}}">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($product_featured as $item_featured)
                        <li>
                            <a href="{{route('product.detail',$item_featured->slug)}}" title="" class="thumb">
                                <img src="{{ $item_featured->imageUrl()}}" style="height: 170px">
                            </a>
                            <a href="{{route('product.detail',$item_featured->slug)}}" title="" class="product-name">{{ $item_featured->product_name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($item_featured->price, 0, '','.')}}đ</span>
                            </div>
                            <a href="{{route('product.detail',$item_featured->slug)}}" class="position-absolute add-cart detail-cart hover-filled-slide-left">
                                <span><i class="fa-solid fa-eye"></i> Xem chi tiết</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Điện thoại</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($product_phone as $phone)
                        <li>
                            <a href="{{route('product.detail',$phone->slug)}}" title="" class="thumb">
                                <img src="{{ $phone->imageUrl() }}" style="width:100%">
                            </a>
                            <a href="{{route('product.detail',$phone->slug)}}" title="" class="product-name" >{{$phone->product_name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($phone->price, 0, '','.')}}đ</span>
                                {{-- <span class="old">8.990.000đđ</span> --}}
                            </div>
                            <a href="{{route('product.detail',$phone->slug)}}" class="position-absolute add-cart detail-cart hover-filled-slide-left">
                                <span><i class="fa-solid fa-eye"></i> Xem chi tiết</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Laptop</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($product_laptop as $laptop)
                        <li>
                            <a href="{{route('product.detail',$laptop->slug)}}" title="" class="thumb">
                                <img src="{{ $laptop->imageUrl() }}" style="width:100%; height:170px">
                            </a>
                            <a href="{{route('product.detail',$laptop->slug)}}" title="" class="product-name">{{$laptop->product_name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($laptop->price, 0, '','.')}}đ</span>
                            </div>
                            <a href="{{route('product.detail',$laptop->slug)}}" class="position-absolute add-cart detail-cart hover-filled-slide-left">
                                <span><i class="fa-solid fa-eye"></i> Xem chi tiết</span>
                            </a>
                        </li>
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
                            <a href="{{route('category.product', $item->slug)}}" title="">{{$item->category_name}}</a>
                            @include('frontend.menu.child', ['item'=>$item])
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm mới nhất</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($product_new as $item_new)
                        <li class="clearfix">
                            <a href="{{route('product.detail',$item_new->slug)}}" title="" class="thumb fl-left">
                                <img src="{{$item_new->imageUrl()}}" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="{{route('product.detail',$item_new->slug)}}" title="" class="product-name">{{$item_new->product_name}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($item_new->price, 0, '','.')}}đ</span>
                                </div>
                                <a href="{{route('product.detail',$item_new->slug)}}" title="" class="buy-now">Xem ngay</a>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="{{asset('images/banner.png')}}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
