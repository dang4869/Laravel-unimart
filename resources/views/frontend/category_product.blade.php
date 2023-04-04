@extends('layouts.frontend')

@section('content')
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('trang-chu')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" aria-disabled="true">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">

          <div class="section" id="list-product-wp">
            <div class="section-head clearfix">
                <h3 class="section-title fl-left">{{$category->category_name}}</h3>
                <div class="filter-wp fl-right">
                    {{-- <p class="desc">Hiển thị 45 trên 50 sản phẩm</p> --}}
                    <div class="form-filter">
                        <form  action="">
                            @csrf
                            <select name="sort" id="sort">
                                <option value="{{Request::url()}}?sort_by=none">Sắp xếp</option>
                                <option value="{{Request::url()}}?sort_by=kytu_az">Từ A-Z</option>
                                <option value="{{Request::url()}}?sort_by=kytu_za">Từ Z-A</option>
                                <option value="{{Request::url()}}?sort_by=giam_dan">Giá cao xuống thấp</option>
                                <option value="{{Request::url()}}?sort_by=tang_dan">Giá thấp lên cao</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            @if ($product->total() > 0)
            <div class="section-detail">
                <ul class="list-item clearfix">
                    @foreach ($product as $item)
                    <li>
                        <a href="{{route('product.detail',$item->slug)}}" title="" class="thumb">
                            <img src="{{$item->imageUrl()}}">
                        </a>
                        <a href="{{route('product.detail',$item->slug)}}" title="" class="product-name">{{$item->product_name}}</a>
                        <div class="price">
                            <span class="new">{{number_format($item->price, 0, '','.')}}đ</span>
                        </div>
                        <a href="{{route('product.detail',$item->slug)}}" class="position-absolute add-cart detail-cart hover-filled-slide-left">
                            <span><i class="fa-solid fa-eye"></i> Xem chi tiết</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                {{$product->links()}}
            </div>
            @endif
            @if ($product_parent->total()>0)
            <div class="section-detail">
                <ul class="list-item clearfix">
                    @foreach ($product_parent as $item_parent)
                    <li>
                        <a href="{{route('product.detail',$item_parent->slug)}}" title="" class="thumb">
                            <img src="{{$item_parent->imageUrl()}}">
                        </a>
                        <a href="{{route('product.detail',$item_parent->slug)}}" title="" class="product-name">{{$item_parent->product_name}}</a>
                        <div class="price">
                            <span class="new">{{number_format($item_parent->price, 0, '','.')}}đ</span>
                        </div>
                        <a href="{{route('product.detail',$item_parent->slug)}}" class="position-absolute add-cart detail-cart hover-filled-slide-left">
                            <span><i class="fa-solid fa-eye"></i> Xem chi tiết</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                {{$product->links()}}
            </div>
            @endif
        </div>


@if ($product->total() == 0 && $product_parent->total() == 0 )
    <span>Không có sản phẩm nào</span>
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
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form  action="" id="myForm">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="sort_price"><input type="radio" name="r-price" value="{{Request::url()}}?sort_by_price=duoi_5t"></td>
                                    <td>Dưới 500.000đ</td>
                                </tr>
                                <tr>
                                    <td class="sort_price"><input type="radio" name="r-price" value="{{Request::url()}}?sort_by_price=tu_5t_1tr"></td>
                                    <td>500.000đ - 1.000.000đ</td>
                                </tr>
                                <tr>
                                    <td class="sort_price"><input type="radio" name="r-price" value="{{Request::url()}}?sort_by_price=tu_1tr_5tr"></td>
                                    <td>1.000.000đ - 5.000.000đ</td>
                                </tr>
                                <tr>
                                    <td class="sort_price"><input type="radio" name="r-price" value="{{Request::url()}}?sort_by_price=tu_5tr_10tr"></td>
                                    <td>5.000.000đ - 10.000.000đ</td>
                                </tr>
                                <tr>
                                    <td class="sort_price"><input type="radio" name="r-price" value="{{Request::url()}}?sort_by_price=tren_10tr"></td>
                                    <td>Trên 10.000.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="{{asset('images/banner.png')}}" alt="">
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
