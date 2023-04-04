<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href=" {{ asset('css/bootstrap/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href=" {{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('reset.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/carousel/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/carousel/owl.theme.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('responsive.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="{{ asset('js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/elevatezoom-master/jquery.elevatezoom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/carousel/owl.carousel.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {!! Toastr::message() !!}
</head>

<body>
    <style>
        #search_ajax {
            position: absolute;
            top: 100px;
            background-color: #fff;
            width: 494px;
            max-height: 300px;
            z-index: 1;
            overflow: hidden;
        }
        .search-ajax{
            display: flex;
            margin-top: 20px;
            margin-bottom: 10px
        }
        #detail {
            height: 600px;
            overflow: hidden;
        }
    </style>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                {{-- @foreach ($pages as $page)
                                <li>
                                    <a href="{{route('page.show',$page->slug)}}" title="">{{$page->name_page}}</a>
                                </li>
                                @endforeach --}}

                                <li>
                                    <a href="{{url('/')}}/" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="{{url('san-pham')}}" title="">Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{{url('tin-tuc')}}" title="">Blog</a>
                                </li>
                                <li>
                                    <a href="{{url('gioi-thieu')}}" title="">Giới thiệu</a>
                                </li>
                                <li>
                                    <a href="{{url('lien-he')}}" title="">Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="{{url('/')}}/" title="" id="logo" class="fl-left"><img
                                src="{{ asset('images/logo.png') }}" /></a>
                        <div id="search-wp" class="fl-left" data-url="{{ url('search/ajax') }}">
                            <form action="{{ url('tim-kiem') }}">
                                <input type="text" name="keyword" id="search"
                                    placeholder="Nhập từ khóa tìm kiếm tại đây!" value="{{ request()->input('keyword') }}">
                                <input type="submit" id="sm-s" value="Tìm kiếm">
                                <div id="search_ajax">

                                </div>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0987.654.321</span>
                            </div>

                            <div id="cart-wp" class="fl-right">
                                <a href="{{url('gio-hang')}}" style="color: #fff">
                                    <div id="btn-cart">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span id="num">{{ Cart::count() }}</span>
                                    </div>
                                </a>

                                @if (Cart::count()>0)
                                <div id="dropdown">
                                    <p class="desc">Có <span id="count">{{ Cart::count() }} </span> <span>sản
                                            phẩm</span> trong giỏ hàng</p>
                                    <ul class="list-cart">
                                        @foreach (Cart::content() as $item)
                                            <li class="clearfix">
                                                <a href="" title="" class="thumb fl-left">
                                                    <img src="{{ url($item->options->thumbnail) }}" alt="">
                                                </a>
                                                <div class="info fl-right">
                                                    <a href="" title=""
                                                        class="product-name">{{ $item->name }}-{{ $item->options->color }}</a>
                                                    <p class="price">{{ number_format($item->price, 0, '', '.') }}đ
                                                    </p>
                                                    <p class="qty">Số lượng: <span
                                                            id="qty">{{ $item->qty }}</span></p>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>
                                    <div class="total-price clearfix">
                                        <p class="title fl-left">Tổng:</p>
                                        <p class="price fl-right" id="total">{{number_format(Cart::total(), 0, '', '.')  }}<span>đ</span>
                                        </p>
                                    </div>
                                    <div class="action-cart clearfix">
                                        <a href="{{ url('gio-hang') }}" title="Giỏ hàng"
                                            class="view-cart fl-left">Giỏ hàng</a>
                                        <a href="{{url('thanh-toan')}}" title="Thanh toán" class="checkout fl-right">Thanh
                                            toán</a>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="wp-content">
                @yield('content')
            </div>
            <div id="footer-wp">
                <div id="foot-body">
                    <div class="wp-inner clearfix">
                        <div class="block" id="info-company">
                            <h3 class="title">ISMART</h3>
                            <p class="desc">ISMART luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng,
                                chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                            <div id="payment">
                                <div class="thumb">
                                    <img src="public/images/img-foot.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="block menu-ft" id="info-shop">
                            <h3 class="title">Thông tin cửa hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <p>106 - Trần Bình - Cầu Giấy - Hà Nội</p>
                                </li>
                                <li>
                                    <p>0987.654.321 - 0989.989.989</p>
                                </li>
                                <li>
                                    <p>vshop@gmail.com</p>
                                </li>
                            </ul>
                        </div>
                        <div class="block menu-ft policy" id="info-shop">
                            <h3 class="title">Chính sách mua hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <a href="" title="">Quy định - chính sách</a>
                                </li>
                                <li>
                                    <a href="" title="">Chính sách bảo hành - đổi trả</a>
                                </li>
                                <li>
                                    <a href="" title="">Chính sách hội viện</a>
                                </li>
                                <li>
                                    <a href="" title="">Giao hàng - lắp đặt</a>
                                </li>
                            </ul>
                        </div>
                        <div class="block" id="newfeed">
                            <h3 class="title">Bảng tin</h3>
                            <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                            <div id="form-reg">
                                <form method="POST" action="">
                                    <input type="email" name="email" id="email"
                                        placeholder="Nhập email tại đây">
                                    <button type="submit" id="sm-reg">Đăng ký</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="foot-bot">
                    <div class="wp-inner">
                        <p id="copyright">© Bản quyền thuộc về unitop.vn | Php Master</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu-respon">
            <a href="?page=home" title="" class="logo">VSHOP</a>
            <div id="menu-respon-wp">
                <ul class="" id="main-menu-respon">
                    <li>
                        <a href="?page=home" title>Trang chủ</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Điện thoại</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="?page=category_product" title="">Iphone</a>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Samsung</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=category_product" title="">Iphone X</a>
                                    </li>
                                    <li>
                                        <a href="?page=category_product" title="">Iphone 8</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Nokia</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Máy tính bảng</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Laptop</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Đồ dùng sinh hoạt</a>
                    </li>
                    <li>
                        <a href="?page=blog" title>Blog</a>
                    </li>
                    <li>
                        <a href="#" title>Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="btn-top"><img src="{{ asset('images/icon-to-top.png') }}" alt="" /></div>
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

</body>

</html>
