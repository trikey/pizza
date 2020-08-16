<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

    <title>Pizza Delivery</title>
</head>
<body>

<div class="header-area">
    <div class="sticky-wrapper is-sticky">
        <div class="sticky-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="{{ route('index') }}">Pizza</a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="main-menu text-center">
                            <ul id="navigation">
                                <li class="smooth-menu"><a href="{{ route('index') }}">Home</a></li>
                                @foreach($categories as $category)
                                    <li class="smooth-menu">
                                        <a href="{{ route('categories.show', ['category' => $category]) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2 text-right">
                        <div class="cart-contact">
                            <div class="mini-cart">
                                <button class="cart-toggle-btn">
                                    <span class="cart-count">2</span>
                                    <i class="las la-shopping-bag"></i>
                                </button>
                            </div>
                            <a href="" class="boxed-btn top">Order Online</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@yield('content')


<footer id="contact">
    <div class="footer-area">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="copy_right">
                        © 2020 Pizza Delivery
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="logo">
                        <a href="{{ route('index') }}">Pizza</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-8">
                    <div class="social-area">
                        <a href=""><i class="lab la-facebook-f"></i></a>
                        <a href=""><i class="lab la-instagram"></i></a>
                        <a href=""><i class="lab la-twitter"></i></a>
                        <a href=""><i class="la la-dribbble"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
