@extends('layouts.frontend')

@section('content')
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($posts as $post)
                        <li class="clearfix">
                            <a href="{{route('blog.detail',$post->slug)}}" title="" class="thumb fl-left">
                                <img src="{{url($post->thumbnail)}}" alt="" >
                            </a>
                            <div class="info fl-right">
                                <a href="{{route('blog.detail',$post->slug)}}" title="" class="title">{{$post->title}}</a>
                                <span class="create-date">{{$post->created_at}}</span>
                                <div class="desc">{!!$post->content!!}</div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    {{$posts->links()}}
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm mới nhất</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($product_new as $item)
                        <li class="clearfix">
                            <a href="{{route('product.detail',$item->slug)}}" title="" class="thumb fl-left">
                                <img src="{{$item->imageUrl()}}" alt="" >
                            </a>
                            <div class="info fl-right">
                                <a href="{{route('product.detail',$item->slug)}}" title="" class="product-name">{{$item->product_name}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($item->price, 0, '','.')}}đ</span>
                                </div>
                                <a href="{{route('product.detail',$item->slug)}}" title="" class="buy-now">Xem ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_blog_product" title="" class="thumb">
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
    .desc{
            height: 30px;
    }
</style>
@endsection
