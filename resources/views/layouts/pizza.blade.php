<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

    <title>Pizza Delivery</title>
</head>
<body>

<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 flex-grid logo-web">
                <div class="logo">
                    <a href="{{ route('index') }}">Pizza</a>
                </div>
                <div class="form-row currency">
                    <div class="my-1">
                        <select class="form-control form-control-sm mr-sm-2">
                            <option>$</option>
                            <option>€</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-4 col-sm-4 col-3 menu-wrapper">
                <div class="main-menu text-center">
                    <div class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <ul id="navigation">
                        <li class="smooth-menu"><a href="{{ route('index') }}">Home</a></li>
                        @foreach($categories as $category)
                            <li class="smooth-menu">
                                <a href="{{ route('categories.show', ['category' => $category]) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                        @guest
                            <li class="smooth-menu">
                                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="smooth-menu">
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="smooth-menu">
                                <a href="{{ route('orders.index') }}">Orders history</a>
                            </li>
                            <li class="smooth-menu">
                                <div>
                                    <a href="{{ route('logout') }}"
                                       onclick="document.getElementById('logout-form').submit(); return false;">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-4 col-4 logo-mob">
                <div class="logo">
                    <a href="{{ route('index') }}">Pizza</a>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-4 col-5 flex-grid">
                <div class="form-row currency logo-mob">
                    <div class="my-1">
                        <select class="form-control form-control-sm mr-sm-2">
                            <option>$</option>
                            <option>€</option>
                        </select>
                    </div>
                </div>
                <div class="cart-contact flex-grid text-right">
                    <button class="cart-toggle-btn">
                        <a class="flex-grid" href="{{ route('cart.index') }}">
                            <span class="cart-count" id="cart-count"></span>
                            <i class="icon"></i>
                        </a>
                    </button>
                    <a href="{{ route('orders.checkout') }}" class="boxed-btn top">Order Online</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrapper">
    <div class="content-wrapper">
        @yield('content')
    </div>
    <div class="footer">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="copy_right">
                        © 2020
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="logo">
                        <a href="{{ route('index') }}">Pizza</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-8">
                    <div class="social-area">
                        <a href=""><i class="icon facebook"></i></a>
                        <a href=""><i class="icon instagram"></i></a>
                        <a href=""><i class="icon twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
