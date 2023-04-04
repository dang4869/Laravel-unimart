<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
    <title>Admintrator</title>
</head>
<script src="https://cdn.tiny.cloud/1/i2lzeuk4jwcsgq37xphtg4eapscfhda71tnq964jouqv4i9y/tinymce/5/tinymce.min.js"
referrerpolicy="origin"></script>
<script>
var editor_config = {
    path_absolute: "http://localhost/unimart/",
    selector: 'textarea',
    relative_urls: false,
    height: 600,
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    file_picker_callback: function(callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
            'body')[0].clientWidth;
        var y = window.innerHeight || document.documentElement.clientHeight || document
            .getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
            url: cmsURL,
            title: 'Filemanager',
            width: x * 0.8,
            height: y * 0.8,
            resizable: "yes",
            close_previous: "no",
            onMessage: (api, message) => {
                callback(message.content);
            }
        });
    }
};

tinymce.init(editor_config);
</script>

<body>
    <div id="warpper" class="nav-fixed">
        <nav class="topnav shadow navbar-light bg-white d-flex">
            <div class="navbar-brand"><a href="{{url('/dashboard')}}">{{ config('app.name', 'Laravel') }}</a></div>
            <div class="nav-right ">
                <div class="btn-group mr-auto">
                    <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="plus-icon fas fa-plus-circle"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item {{'admin/post/add' == request()->path() ? 'active' : ''}}" href="{{url('admin/post/add')}}">Thêm bài viết</a>
                        <a class="dropdown-item {{'admin/product/add' == request()->path() ? 'active' : ''}}" href="{{url('admin/product/add')}}">Thêm sản phẩm</a>
                        <a class="dropdown-item {{'admin/order/list' == request()->path() ? 'active' : ''}}" href="{{url('admin/order/list')}}">Xem đơn hàng</a>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->name}}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item {{'profile' == request()->path() ? 'active' : ''}}" href="{{url('profile')}}">Thông tin tài khoản</a>
                        <a class="dropdown-item {{'changpassword' == request()->path() ? 'active' : ''}}" href="{{url('changpassword')}}">Đổi mật khẩu</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Đăng Xuất') }}
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
                        {{-- <a class="dropdown-item" href="{{route('logout')}}">Thoát</a> --}}
                    </div>
                </div>
            </div>
        </nav>
        <!-- end nav  -->
        @php
            $module_active = session('module_active')
        @endphp
        @php
            $user = Auth::user();
        @endphp
        <div id="page-body" class="d-flex">
            <div id="sidebar" class="bg-white">
                <ul id="sidebar-menu">
                    <li class="nav-link {{$module_active == 'dashboard' ? 'active' : ''}}">
                        <a href="{{url('dashboard')}} ">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Dashboard
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                    </li>
                    @if ($user->can('admin.page.list'))
                    <li class="nav-link {{$module_active == 'page' ? 'active' : ''}}">
                        <a href="{{route('admin.page.list')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Trang
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{url('admin/page/add')}}">Thêm mới</a></li>
                            <li><a href="{{url('admin/page/list')}}">Danh sách</a></li>
                        </ul>
                    </li>
                    @endif
                    @if ($user->can('admin.post.list'))
                    <li class="nav-link {{$module_active == 'post' ? 'active' : ''}}">
                        <a href="{{route('admin.post.list')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Bài viết
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{url('admin/post/add')}}">Thêm mới</a></li>
                            <li><a href="{{url('admin/post/list')}}">Danh sách</a></li>
                            <li><a href="{{url('admin/post/cat/add')}}">Danh mục</a></li>
                        </ul>
                    </li>
                    @endif
                    @if ($user->can('admin.product.list'))
                    <li class="nav-link {{$module_active == 'product' ? 'active' : ''}}">
                        <a href="{{route('admin.product.list')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Sản phẩm
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{url('admin/product/add')}}">Thêm mới</a></li>
                            <li><a href="{{url('admin/product/list')}}">Danh sách</a></li>
                            <li><a href="{{url('admin/product/cat/list')}}">Danh mục</a></li>
                        </ul>
                    </li>
                    @endif
                    @if ($user->can('admin.order.list'))
                    <li class="nav-link {{$module_active == 'order' ? 'active' : ''}}">
                        <a href="{{route('admin.order.list')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Bán hàng
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{url('admin/order/list')}}">Đơn hàng</a></li>
                        </ul>
                    </li>
                    @endif
                    @if ($user->can('admin.user.list'))
                    <li class="nav-link {{$module_active == 'user' ? 'active' : ''}}">
                        <a href="{{route('admin.user.list')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Users
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{url('admin/user/add')}}">Thêm mới</a></li>
                            <li><a href="{{url('admin/user/list')}}">Danh sách</a></li>
                        </ul>
                    </li>
                    @endif
                    @if ($user->can('admin.role.list'))
                    <li class="nav-link {{$module_active == 'role' ? 'active' : ''}}">
                        <a href="{{route('admin.role.list')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Nhóm quyền
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{url('admin/role/add')}}">Thêm mới</a></li>
                            <li><a href="{{url('admin/role/list')}}">Danh sách</a></li>
                        </ul>
                    </li>
                    @endif
                    @if ($user->can('admin.slider.list'))
                    <li class="nav-link {{$module_active == 'slider' ? 'active' : ''}}">
                        <a href="{{route('admin.slider.list')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Slider
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                    </li>
                    @endif
                </ul>
            </div>
            <div id="wp-content">
                @yield('content')
            </div>
        </div>


    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{asset('js/app.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    @yield('js')
</body>

</html>
