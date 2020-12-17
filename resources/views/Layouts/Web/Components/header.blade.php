<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{url('index')}}"><img src="img/logo copy.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item {{ (\Request::route()->getName() == 'web.index') ? 'active' : '' }}"><a class="nav-link" href="{{url('index')}}">Trang chủ</a></li>
                        <li class="nav-item {{ (\Request::route()->getName() == 'category.index') ? 'active' : '' }}"><a class="nav-link" href="{{url('category')}}">Sản phẩm</a></li>
                        <li class="nav-item submenu dropdown {{
                                (\Request::route()->getName() == 'auth.login') ||
                                (\Request::route()->getName() == 'auth.getsignup') ||
                                (\Request::route()->getName() == 'auth.change_password') ||
                                (\Request::route()->getName() == 'auth.forgot_password')
                                ? 'active' : ''
                                }}">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">Tài khoản</a>
                            <ul class="dropdown-menu">
                                @if(Auth::check())
                                    <li class="nav-item"><a class="nav-link" href="login.html">Tra cứu đơn hàng</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{url('auth/logout')}}">Đăng xuất</a></li>
                                @else
                                    <li class="nav-item"><a class="nav-link" href="{{url('auth/login')}}">Đăng nhập</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{url('auth/signup')}}">Tạo tài khoản</a></li>
                                @endif
                            </ul>
                        </li>
{{--                        <li class="nav-item {{ (\Request::route()->getName() == 'web.blog') ? 'active' : '' }}"><a class="nav-link" href="{{url('blog')}}">Blog</a></li>--}}
                        <li class="nav-item {{ (\Request::route()->getName() == 'web.contact') ? 'active' : '' }}"><a class="nav-link" href="{{url('contact')}}">Liên hệ</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item {{ (\Request::route()->getName() == 'web.cart') ? 'active' : '' }}"><a href="{{url('cart')}}" class="cart"><span class="ti-bag"></span></a></li>
                        <li class="nav-item">
                            <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container">
            <form class="d-flex justify-content-between" method="get" action="{{url('search')}}">
                <input type="text" class="form-control" name="key" id="search_input" placeholder="Search Here">
                <button type="submit" class="btn"></button>
                <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div>
</header>
<!-- End Header Area -->
